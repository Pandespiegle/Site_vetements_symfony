<?php

namespace App\DataFixtures;

use App\Entity\Chaussure;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ChaussureFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $nomPointure = [35, 35.5, 36, 36.5, 37, 37.5, 38, 38.5, 39, 39.5, 40];
        $nomMarque = ["Nike", "Adidas", "Lacoste"];
        $nomCategorie = ["Homme", "Femme", "Enfant"];

        foreach($nomPointure as $key => $pointure) {
            foreach($nomMarque as $key2 => $marque){
                foreach($nomCategorie as $key3 => $categorie){
                    $chaussure = new Chaussure();
                    $chaussure->setName($categorie . ' ' . $marque . ' ' . $pointure);
                    $chaussure->setPrix(rand(10, 100));
                    $chaussure->setImageUrl('https://assets.adidas.com/images/w_600,f_auto,q_auto/aa53a0a800c846abb44aae8a00367e1d_9366/Chaussure_a_lacets_Tensaur_Sport_Training_Blanc_GW6422_01_standard.jpg');
                    $chaussure->setCategorie($this->getReference(CategorieFixtures::CATEGORIE_REFERENCE . ' ' . $key3));
                    $chaussure->setMarque($this->getReference(MarqueFixtures::MARQUE_REFERENCE . ' ' . $key2));
                    $chaussure->addPointure($this->getReference(PointureFixtures::POINTURE_REFERENCE . ' ' . $key));
                    $manager->persist($chaussure);
                }
            }
        }


        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategorieFixtures::class,
            MarqueFixtures::class,
            PointureFixtures::class,
        ];
    }
}
