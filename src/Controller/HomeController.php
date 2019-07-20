<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/hello/{prenom}/age/{age}", name="hello")
     * @Route("/hello", name="hello_base")
     * @Route("/hello/{prenom}",name="hello_prenom")
     * Montre la page qui dit bonjour
     * @return Response
     */
    public function hello($prenom = 'anonyme', $age = 0)
    {
        return new Response('Bonjour '.$prenom.' vous avez '.$age);
    }


    /**
     * @Route("/", name="homepage")
     */
    public function home() {
        $prenom = ['Benjamin' => 23, 'Norbert' => 18, 'Andrée' => 33];
        return $this->render(
            'home.html.twig',
            [
                'title' => 'Bonjour à tous',
                'age' => 15,
                'tab' => $prenom
            ]
        );
    }
}