<?php

namespace App\DataFixtures;

use App\Entity\Vetement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VetementFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $nomTaille = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
        $nomMarque = ["Nike", "Adidas", "Lacoste"];
        $nomCategorie = ["Homme", "Femme", "Enfant"];

        foreach($nomTaille as $key => $taille) {
            foreach($nomMarque as $key2 => $marque){
                foreach($nomCategorie as $key3 => $categorie){
                    $vetement = new Vetement();
                    $vetement->setName($categorie . ' ' . $marque . ' ' . $taille);
                    $vetement->setPrix(rand(10, 100));
                    $vetement->setImageUrl('https://www.europann.com/9355-thickbox_default/ron-pull-fin-a-capuche-marine-noir.jpg');
                    $vetement->setCategorie($this->getReference(CategorieFixtures::CATEGORIE_REFERENCE . ' ' . $key3));
                    $vetement->setMarque($this->getReference(MarqueFixtures::MARQUE_REFERENCE . ' ' . $key2));
                    $vetement->setTaille($this->getReference(TailleFixtures::TAILLE_REFERENCE . ' ' . $key));
                    $manager->persist($vetement);
                }
            }
        }


        $manager->flush();
    }
}
