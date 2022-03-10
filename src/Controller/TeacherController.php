<?php

namespace App\Controller;

use App\Entity\Teacher;
use App\Form\TeacherType;
use App\Repository\TeacherRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/teacher")
 */
class TeacherController extends AbstractController
{
    /**
     * @Route("/", name="teacher_index")
     */
    public function index()
    {
        $teacher = $this->getDoctrine()->getRepository(Teacher::class)->findAll();
        return $this->render('teacher/index.html.twig', [
            'teachers' => $teacher,
        ]);
    }

    /**
     * @Route("/detail/{id}", name="teacher_detail")
     */
    public function detail($id)
    {
        $teacher = $this->getDoctrine()->getRepository(Teacher::class)->find($id);
        return $this->render('teacher/detail.html.twig', [
            'teacher' => $teacher,
        ]);
    }

    /**
     * @Route("/add", name="teacher_add")
     */
    public function add(Request $request)
    {
        $teacher = new Teacher();
        $form = $this->createForm(TeacherType::class, $teacher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($teacher);
            $manager->flush();
            return $this->redirectToRoute('teacher_index');
        }

        return $this->renderForm('teacher/add.html.twig', [

            'form' => $form,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="teacher_edit")
     */
    public function edit(Request $request, $id)
    {
        $teacher = $this->getDoctrine()->getRepository(Teacher::class)->find($id);
        $form = $this->createForm(TeacherType::class, $teacher);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($teacher);
            $manager->flush();
            return $this->redirectToRoute("teacher_index");
        }
        return $this->renderForm(
            "teacher/edit.html.twig",
            [
                'form' => $form
            ]
        );
    }

    /**
     * @Route("/delete/{id}", name="teacher_delete")
     */
    public function delete($id)
    {
        $teacher = $this->getDoctrine()->getRepository(Teacher::class)->find($id);
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($teacher);
        $manager->flush();
        return $this->redirectToRoute("teacher_index");
    }
}
