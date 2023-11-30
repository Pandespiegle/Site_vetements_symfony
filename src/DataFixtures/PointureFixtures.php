<?php

namespace App\DataFixtures;

use App\Entity\Pointure;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PointureFixtures extends Fixture 
{ 
    public const POINTURE_REFERENCE = 'pointure';
    public function load(ObjectManager $manager): void
    {
        $nomPointure = [35, 35.5, 36, 36.5, 37, 37.5, 38, 38.5, 39, 39.5, 40];
        foreach($nomPointure as $key => $value) {
            $pointure = new Pointure();
            $pointure->setPointure($value);
            $manager->persist($pointure);
            $this->addReference(self::POINTURE_REFERENCE . ' ' . $key, $pointure);
        }
        $manager->flush();
    }

    
}
