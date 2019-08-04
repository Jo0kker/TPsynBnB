<?php

namespace App\Form;

use App\Entity\Ad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnonceType extends ApplicationType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title',
                TextType::class,
                $this->getConfiguration(
                    'Titre',
                    'Tapez un super titre'
                ))


            ->add(
                'converImage',
                UrlType::class,
                $this->getConfiguration(
                    'Url de l\'image principale',
                    'l\'adresse de l\'image'
                ))

            ->add(
                'introduction',
                TextType::class,
                $this->getConfiguration(
                    'Introduction',
                    'Donnez une descrition de l\'annonce'
                ))

            ->add(
                'content',
                TextareaType::class,
                $this->getConfiguration(
                    'Descrition détaillé',
                    'desc qui donne envie'
                ))

            ->add(
                'rooms',
                IntegerType::class,
                $this->getConfiguration(
                    'Nombre de chambre',
                    'Nombre de chambre disponible'
                ))

            ->add(
                'price',
                MoneyType::class,
                $this->getConfiguration(
                    'Prix par nuit',
                    'Prix que vous voulez pour une nuit'
                ))

            ->add(
                'images',
                CollectionType::class, [
                    'entry_type' => ImageType::class,
                    'allow_add' => true,
                    'allow_delete' => true
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
