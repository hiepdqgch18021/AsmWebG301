<?php

namespace App\Controller;

use App\Entity\Teacher;
use App\Form\Teacher1Type;
use App\Repository\TeacherRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/crud/teacher')]
class CrudTeacherController extends AbstractController
{
    #[Route('/', name: 'crud_teacher_index', methods: ['GET'])]
    public function index(TeacherRepository $teacherRepository): Response
    {
        return $this->render('crud_teacher/index.html.twig', [
            'teachers' => $teacherRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'crud_teacher_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $teacher = new Teacher();
        $form = $this->createForm(Teacher1Type::class, $teacher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($teacher);
            $entityManager->flush();

            return $this->redirectToRoute('crud_teacher_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('crud_teacher/new.html.twig', [
            'teacher' => $teacher,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'crud_teacher_show', methods: ['GET'])]
    public function show(Teacher $teacher): Response
    {
        return $this->render('crud_teacher/show.html.twig', [
            'teacher' => $teacher,
        ]);
    }

    #[Route('/{id}/edit', name: 'crud_teacher_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Teacher $teacher, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Teacher1Type::class, $teacher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('crud_teacher_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('crud_teacher/edit.html.twig', [
            'teacher' => $teacher,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'crud_teacher_delete', methods: ['POST'])]
    public function delete(Request $request, Teacher $teacher, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$teacher->getId(), $request->request->get('_token'))) {
            $entityManager->remove($teacher);
            $entityManager->flush();
        }

        return $this->redirectToRoute('crud_teacher_index', [], Response::HTTP_SEE_OTHER);
    }
}
