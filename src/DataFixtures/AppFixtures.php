<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use App\Entity\Image;
use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    
    
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');

        $adminRole = new Role();
        $adminRole->setTitle('ROLE_ADMIN');
        $manager->persist($adminRole);

        $adminUser = new User();
        $adminUser
            ->setFirstName('ben')
            ->setLastName('Roma')
            ->setEmail('admin@admin.fr')
            ->setHash($this->encoder->encodePassword($adminUser,'password'))
            ->setPicture('http://avatars.io/twitter/LiiorC')
            ->setIntroduction($faker->sentence())
            ->setDescription('<p>'.implode('</p><p>',$faker->paragraphs(3)).'</p>')
            ->addUserRole($adminRole);
        $manager->persist($adminUser);

        $users = [];

        $genders = ['men', 'women'];
        for ($i = 1; $i <= 10; $i++) {
            $user = new User();

            $gender = $faker->randomElement($genders);

            $picture = 'https://randomuser.me/api/portraits/';
            $pictureId = $faker->numberBetween(1, 99).'.jpg';

            $picture .= "$gender/".$pictureId;

            $hash = $this->encoder->encodePassword($user, 'password');

            $user
                ->setFirstName($faker->firstName($gender))
                ->setLastName($faker->lastName)
                ->setEmail($faker->email)
                ->setIntroduction($faker->sentence())
                ->setDescription('<p>'.implode('</p><p>',$faker->paragraphs(3)).'</p>')
                ->setPicture($picture)
                ->setHash($hash);

            $manager->persist($user);
            $users[] = $user;
        }

        for ($i = 1;$i <= 30; $i++) {
            $ad = new Ad();
            $title = $faker->sentence();
            $coverImage = $faker->imageUrl(1000,350);
            $introduction = $faker->paragraph(2);
            $content = '<p>'.implode('</p><p>',$faker->paragraphs(5)).'</p>';
            $user = $users[mt_rand(0, count($users) - 1)];

            $ad->setTitle($title)
                ->setConverImage($coverImage)
                ->setIntroduction($introduction)
                ->setContent($content)
                ->setPrice(mt_rand(40, 200))
                ->setRooms(mt_rand(1,5))
                ->setAuthor($user);

            for ($j = 1; $j <= mt_rand(2,5); $j++){
                $image = new Image();
                $image->setUrl($faker->imageUrl())
                    ->setCaption($faker->sentence())
                    ->setAd($ad);
                $manager->persist($image);
            }

            $manager->persist($ad);
        }
        $manager->flush();
    }
}
