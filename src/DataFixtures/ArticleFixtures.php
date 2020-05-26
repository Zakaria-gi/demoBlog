<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 10; $i++) // on boucle 10 fois afin de créer 10 articles 
        {
            $article = new Article; // on instance la classe Article afin de renseigner les propriétés private et d'envoyer les objets 
            // type Article en BDD, la classe Article reflète la table SQL 'article'

            // On renseigne tout les setteurs de la classe Article afin d'ajouter des titres, du contenu etc qui seront insérés en BDD
            $article->setTitle("Titre de l'article n° $i")
                    ->setContent("<p>Contenu de l'article n° $i</p>")
                    ->setImage("https://picsum.photos/seed/picsum/200/300")
                    ->setCreatedAt(new \DateTime()); // objet classe DateTime
            
            $manager->persist($article); // persist() est une méthode issue de la classe objetManager permettant de garder en mémoire
            // les objets Articles crées, il est fait persister dans le temps
        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush(); // flush() est une méthode issue de la classe ObjetManager qui permet véritablement de générer l'insertion
        // en BDD 
    }
}
