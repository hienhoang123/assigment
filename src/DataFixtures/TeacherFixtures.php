<?php

namespace App\DataFixtures;

use App\Entity\Teacher;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TeacherFitures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=1;$i<=10;$i++){
            $teacher = new Teacher;
            $teacher->setName("teacher $i");   
            $teacher->setAddress("Ha Noi");     
            $teacher->setAvatar("https://img.freepik.com/free-vector/man-character-avatar-icon-teacher-male-with-chalkboard_51635-2975.jpg");
            $teacher->setPhone("012345678");
            $teacher->setEmail("Teacher email $i");
            $manager->persist($teacher);
        }
        $manager->flush();
    }
}
