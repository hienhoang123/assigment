<?php

namespace App\DataFixtures;

use App\Entity\Clase;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClaseFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=1;$i<10;$i++){
            $clase=new Clase;
            $clase->setName("Class$i");
            $clase->setMajor("IT");
            $clase->setNumber(rand(25,30));
            $clase->setSemester("Spring");
            $clase->setTeacher("Teacher$i");
            $manager->persist($clase);
        }

        $manager->flush();
    }
}
