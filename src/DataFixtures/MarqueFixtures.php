<?php

namespace App\DataFixtures;

use App\Entity\Marque;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MarqueFixtures extends Fixture 
{
    public const MARQUE_REFERENCE = 'marque';
    public function load(ObjectManager $manager): void
    {
        $nomMarque = ["Nike", "Adidas", "Lacoste"];
        foreach($nomMarque as $key => $value) {
            $marque = new Marque();
            $marque->setName($value);
            $manager->persist($marque);
            $this->addReference(self::MARQUE_REFERENCE . ' ' . $key, $marque);
        }


        $manager->flush();
    }

    
}
