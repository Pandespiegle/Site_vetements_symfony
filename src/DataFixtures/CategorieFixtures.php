<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieFixtures extends Fixture 
{
    public const CATEGORIE_REFERENCE = 'categorie';
    public function load(ObjectManager $manager): void
    {
        $nomCategorie = ["Homme", "Femme", "Enfant"];
        foreach($nomCategorie as $key => $value) {
            $categorie = new Categorie();
            $categorie->setName($value);
            $manager->persist($categorie);
            $this->addReference(self::CATEGORIE_REFERENCE . ' ' . $key, $categorie);
        }
        $manager->flush();
    }

   
    
}
