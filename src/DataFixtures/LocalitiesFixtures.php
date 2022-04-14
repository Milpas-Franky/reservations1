<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Localities;

class LocalitiesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $localities = [
            ['postal_code'=>'1000','locality'=>'Bruxelles'],
            ['postal_code'=>'1030','locality'=>'Schaerbeek'],
            ['postal_code'=>'1050','locality'=>'Ixelles'],
            ['postalCode' => '1170', 'locality' => 'Watermael-Boitsfort',],
        ];
        
        foreach ($localities as $record) {
            $locality = new Localities();
            $locality->setPostalCode($record['postal_code']);
            $locality->setLocality($record['locality']);
            $manager->persist($locality);

            $this->addReference($record['locality'], $locality);
        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
