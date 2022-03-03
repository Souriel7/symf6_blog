<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Commentaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $cat = new Categorie();
            $cat->setNom("Nouvelle categorie " . $i);
            $manager->persist($cat);

            for ($j = 1; $j <= 10; $j++) {
                $article = new Article();
                $article->setTitre("Nouvel article n°" . $j);
                $article->setContenu("Lorem, ipsum dolor sit amet consectetur adipisicing elit.");
                $article->setDatePublication(new \DateTime());
                $article->setImageSrc("toto.jpg");
                $article->setNombreVues(0);
                $article->setCategorie($cat);
                $manager->persist($article);

                for ($k = 1; $k <= 5; $k++) {
                    $commentaire = new Commentaire();
                    $commentaire->setDate(new \DateTime());
                    $commentaire->setContenu("Super article !" . $k);
                    $commentaire->setPublie(false);
                    $commentaire->setArticle($article);
                    $manager->persist($commentaire);
                }
            }
        }


        $manager->flush();
    }
}
