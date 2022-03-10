<?php

namespace App\Controller;

use App\Entity\Subject;
use App\Form\SubjectType;
use App\Repository\SubjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/subject")
 */
class SubjectController extends AbstractController
{
    /**
     * @Route("/", name="subject_index")
     */
    public function index()
    {
        $subject = $this->getDoctrine()->getRepository(Subject::class)->findAll();
       return $this->render("subject/index.html.twig",
       [
           'subjects' => $subject
       ]);
    }
    
    /**
     * @Route("/detail/{id}", name="subject_detail")
     */
    public function detail($id)
    {
        $subject = $this->getDoctrine()->getRepository(Subject::class)->find($id);
        return $this->render('subject/detail.html.twig', [
            'subject' => $subject,
        ]);
    }

    /**
     * @Route("/add", name="subject_add")
     */
    public function add(Request $request)
    {
        $subject = new Subject();
        $form = $this->createForm(SubjectType::class, $subject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($subject);
            $manager->flush();
            return $this->redirectToRoute('subject_index');
        }

        return $this->renderForm('subject/add.html.twig', [
            'subject' => $subject,
            'form' => $form
        ]);
    }

    /**
     * @Route("/edit/{id}", name="subject_edit")
     */
    public function edit(Request $request, $id)
    {
        $subject = $this->getDoctrine()->getRepository(subject::class)->find($id);
        $form = $this->createForm(SubjectType::class, $subject);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($subject);
            $manager->flush();
            return $this->redirectToRoute("subject_index");
        }
        return $this->renderForm(
            "subject/edit.html.twig",
            [
                'form' => $form
            ]
        );
    }


    /**
     * @Route("/delete/{id}", name="subject_delete")
     */
    public function delete($id)
    {
        $subject = $this->getDoctrine()->getRepository(Subject::class)->find($id);
        $manager = $this->getDoctrine()->getManager();
        $manager->remove($subject);
        $manager->flush();
        return $this->redirectToRoute("subject_index");
    }
}
