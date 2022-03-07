<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Commentaire;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasherInterface)
    {
        $this->passwordHasher = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager): void
    {
        // on crée un user
        $toto = new User();
        $toto->setEmail("toto@toto.fr");
        $toto->setDateCreation(new \DateTime());
        $toto->setPseudo("toto");
        $hash = $this->passwordHasher->hashPassword($toto, "toto");
        $toto->setPassword($hash);
        $manager->persist($toto);

        // on crée un user
        $tata = new User();
        $tata->setEmail("tata@tata.fr");
        $tata->setDateCreation(new \DateTime());
        $tata->setPseudo("tata");
        $hash = $this->passwordHasher->hashPassword($tata, "tata");
        $tata->setPassword($hash);
        $manager->persist($tata);

        // on crée des catégories
        for ($i = 1; $i <= 3; $i++) {
            $cat = new Categorie();
            $cat->setNom("Nouvelle categorie " . $i);
            // $manager->persist($cat);
            // on crée des articles
            for ($j = 1; $j <= 5; $j++) {
                $article = new Article();
                $article->setTitre("Nouvel article n°" . $i . $j);
                $article->setContenu("Lorem, ipsum dolor sit amet consectetur adipisicing elit.");
                $article->setDatePublication(new \DateTime());
                $article->setImageSrc("toto.jpg");
                $article->setNombreVues(0);
                $article->setCategorie($cat);
                $article->setUser($toto); // toto est l'auteur des articles
                $manager->persist($article);
                // on crée des commentaires
                for ($k = 1; $k <= 2; $k++) {
                    $commentaire = new Commentaire();
                    $commentaire->setDate(new \DateTime());
                    $commentaire->setContenu("Super article !" . $k);
                    $commentaire->setPublie(false);
                    $commentaire->setArticle($article);
                    $commentaire->setUser($tata); // tata est l'auteur des commentaires
                    $manager->persist($commentaire);
                }
            }
        }


        $manager->flush();
    }
}
