<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $cat = new Categorie();
        $cat->setNom("Nouvelles technologies");
        $manager->persist($cat);

        $article = new Article();
        $article->setTitre("Les ordinateurs en bois");
        $article->setContenu("Lorem, ipsum dolor sit amet consectetur adipisicing elit.");
        $article->setDatePublication(new \DateTime());
        $article->setImageSrc("toto.jpg");
        $article->setNombreVues(0);
        $article->setCategorie($cat);
        $manager->persist($article);

        $manager->flush();
    }
}
