<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    // Un commentaire qui commence par un '@' est une annotation trés importante, synfony explique que lorsqu'on lancera 
    // www.monsite.com/blog on fera appel à la méthode index()
    // Pas besoin de péciser tamplates/blog/index.html.twig, Symfony sait où se trouve les fichiers templates de rendu

    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('blog/home.html.twig', [
            'titre' => 'Bienvenue sur le blog Symfony',
            'age' => 25
        ]);
    }
}
