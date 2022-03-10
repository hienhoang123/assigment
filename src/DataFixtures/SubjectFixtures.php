<?php

namespace App\DataFixtures;

use App\Entity\Subject;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SubjectFitures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=1;$i<=5;$i++){
            $subject = new Subject;
            $subject->setScore("10"); 
            $subject->setName("Subject $i");
            $subject->setTime("10");
        }
        $manager->flush();
    }
}
