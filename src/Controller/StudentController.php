<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/student')]
class StudentController extends AbstractController
{
    #[Route('/', name:'student_index')]
    public function studentList(){
      $student=$this->getDoctrine()->getRepository(Student::class)->findAll();
        return $this->render("student/index.html.twig",
        [
            'students'=>$student
        ]);
    }
 
    #[Route('/detail/{id}', name:'student_detail')]
    public function studentDetail($id){
        $student=$this->getDoctrine()->getRepository(Student::class)->find($id);
        return $this->render("student/detail.html.twig",
        [
            'student'=>$student
        ]);
    }
 
    #[Route('/delete/{id}', name:'student_delete')]
    public function studentDelete($id){
     $student=$this->getDoctrine()->getRepository(Student::class)->find($id);
     if(count($student->getClase())==0){
         $manger=$this->getDoctrine()->getManager();
         $manger->remove($student);
         $manger->flush();
     }
     $this->addFlash("Success","Delete student success");
     return $this->redirectToRoute("student_index");
    }
 
    #[Route('/add', name:'student_add')]
    public function studentAdd(Request $request){
        $student=new Student;
        $form=$this->createForm(StudentType::class,$student);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
         $manger=$this->getDoctrine()->getManager();
         $manger->persist($student);
         $manger->flush();
         return $this->redirectToRoute("student_index");
        }
        return $this->renderForm("student/add.html.twig",
        [
            'studentForm'=>$form
        ]);
    }
 
    #[Route('/edit/{id}', name:'student_edit')]
    public function studentEdit(Request $request,$id){
     $student=$this->getDoctrine()->getRepository(Student::class)->find($id);
     $form=$this->createForm(StudentType::class,$student);
     $form->handleRequest($request);
     if($form->isSubmitted()&&$form->isValid()){
         $manger=$this->getDoctrine()->getManager();
         $manger->persist($student);
         $manger->flush();
         return $this->redirectToRoute("student_index");
     }
     return $this->renderForm("student/edit.html.twig",
     [
         'studentForm'=>$form
     ]);
    }

    #[Route('/asc', name: 'sort_name_asc')]
    public function sortNameAscending(StudentRepository $studentRepository) {
       $student = $studentRepository->sortStudentAsc();
       return $this->render('student/index.html.twig',
       [
           'students' => $student
       ]); 
    }
 
    #[Route('/desc', name: 'sort_name_desc')]
    public function sortNameDescending(StudentRepository $studentRepository) {
       $student = $studentRepository->sortStudentDesc();
       return $this->render('student/index.html.twig',
       [
           'students' => $student
       ]); 
    }

    
}
