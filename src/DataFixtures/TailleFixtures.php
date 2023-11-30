<?php

namespace App\DataFixtures;

use App\Entity\Taille;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TailleFixtures extends Fixture 
{

    public const TAILLE_REFERENCE = 'taille';
    public function load(ObjectManager $manager): void
    {
        $nomTaille = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
        foreach($nomTaille as $key => $value) {
            $taille = new Taille();
            $taille->setName($value);
            $manager->persist($taille);
            $this->addReference(self::TAILLE_REFERENCE . ' ' . $key, $taille);
        }
        $manager->flush();
    }

    
}
