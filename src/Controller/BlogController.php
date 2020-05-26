<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
        /*
            Pour selectionner des donnéess en BDD, nous avons besoin de la classe Repository de la classe Article
            Une classe Repository permet uniquement de selectionner des données en BDD (requete SQL SELECT)
            On a besoin de l'ORM DOCTRINE pour faire la relation entre la BDD et notre appilication (getDoctrine())
            getRepository() : méthode issue de l'objet DOCTRINE qui permet d'importer une classe Repository (SELECT)

            $repo est un objet issu de la classe ArticleRepository, cette dernieres contient des méthodes prédéfinies par SYMFONY
            permettant de selectionner des données en BDD (find, findBy, findOneBy, findAll)

            dump() : équivalent de var_dump(), permet d'observer le resultat de la requete de selection en bas de la page dans 
            la barre administrative (cible à droite)
        */

        $repo = $this->getDoctrine()->getRepository(Article::class);

        $article = $repo->findAll();
        // findAll() est une méthode issue de la classe ArticleRepository qui permet de selectionner l'ensemble de la table (similaire à SELECT * FROM article)

        dump($article);

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

    // show() : méthode permettant d'afficher le détail d'1 article 

    /**
     * @Route("/blog/45", name="blog_show")
     */
    public function show()
    {
        return $this->render('blog/show.html.twig');
    }

    // Crée 1 méthode create() (route '/create') renvoie le template create.html.twig + un peu de contenu dans le template +
    // test navigateur 
}
