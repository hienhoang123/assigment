<?php

namespace App\Controller;

use App\Entity\Clase;
use App\Form\ClaseType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/clase')]
class ClaseController extends AbstractController
{
    #[Route('/', name:'clase_index')]
    public function claseList(){
      $clase=$this->getDoctrine()->getRepository(Clase::class)->findAll();
        return $this->render("clase/index.html.twig",
        [
            'clases'=>$clase
        ]);
    }
 
    #[Route('/detail/{id}', name:'clase_detail')]
    public function claseDetail($id){
        $clase=$this->getDoctrine()->getRepository(Clase::class)->find($id);
        return $this->render("clase/detail.html.twig",
        [
            'clase'=>$clase
        ]);
    }
 
    #[Route('/delete/{id}', name:'clase_delete')]
    public function claseDelete($id){
     $clase=$this->getDoctrine()->getRepository(Clase::class)->find($id);
     if(count($clase->getStudents())==0){
         $manger=$this->getDoctrine()->getManager();
         $manger->remove($clase);
         $manger->flush();
     }
     $this->addFlash("Success","Delete class success");
     return $this->redirectToRoute("clase_index");
    }
 
    #[Route('/add', name:'clase_add')]
    public function claseAdd(Request $request){
        $clase=new Clase;
        $form=$this->createForm(ClaseType::class,$clase);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
         $manger=$this->getDoctrine()->getManager();
         $manger->persist($clase);
         $manger->flush();
         return $this->redirectToRoute("clase_index");
        }
        return $this->renderForm("clase/add.html.twig",
        [
            'classForm'=>$form
        ]);
    }
 
    #[Route('/edit/{id}', name:'clase_edit')]
    public function claseEdit(Request $request,$id){
     $clase=$this->getDoctrine()->getRepository(Clase::class)->find($id);
     $form=$this->createForm(ClaseType::class,$clase);
     $form->handleRequest($request);
     if($form->isSubmitted()&&$form->isValid()){
         $manger=$this->getDoctrine()->getManager();
         $manger->persist($clase);
         $manger->flush();
         return $this->redirectToRoute("clase_index");
     }
     return $this->renderForm("clase/edit.html.twig",
     [
         'classForm'=>$form
     ]);
    }
}
