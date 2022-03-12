<?php

namespace App\DataFixtures;

use App\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StudentFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=1;$i<10;$i++){
            $student=new Student;
            $student->setName("Student $i");
            $student->setEmail("student$i@gmail.com");
            $student->setBirth(\DateTime::createFromFormat('Y-m-d','2002-6-3'));
            $student->setPhone("038290298");
            $student->setImage("https://tse2.mm.bing.net/th?id=OIP.P5JF1wy8DL6VTLF7t00MzgHaGz&pid=Api&P=0&w=212&h=195");
            $student->setAddress("District $i");
            $manager->persist($student);
        }

        $manager->flush();
    }
}
