<?php


namespace App\Controller;


use App\Repository\AdRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{


    /**
     * @Route("/", name="homepage")
     */
    public function home(AdRepository $adRepository, UserRepository $userRepository) {
        $prenom = ['Benjamin' => 23, 'Norbert' => 18, 'Andrée' => 33];
        return $this->render(
            'home.html.twig',
            [
                'ads' => $adRepository->findBestAds(3),
                'users' => $userRepository->findBestUsers(3)
            ]
        );
    }
}