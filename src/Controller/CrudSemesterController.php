<?php

namespace App\Controller;

use App\Entity\Semester;
use App\Form\Semester1Type;
use App\Repository\SemesterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/crud/semester')]
class CrudSemesterController extends AbstractController
{
    #[Route('/', name: 'crud_semester_index', methods: ['GET'])]
    public function index(SemesterRepository $semesterRepository): Response
    {
        return $this->render('crud_semester/index.html.twig', [
            'semesters' => $semesterRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'crud_semester_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $semester = new Semester();
        $form = $this->createForm(Semester1Type::class, $semester);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($semester);
            $entityManager->flush();

            return $this->redirectToRoute('crud_semester_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('crud_semester/new.html.twig', [
            'semester' => $semester,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'crud_semester_show', methods: ['GET'])]
    public function show(Semester $semester): Response
    {
        return $this->render('crud_semester/show.html.twig', [
            'semester' => $semester,
        ]);
    }

    #[Route('/{id}/edit', name: 'crud_semester_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Semester $semester, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Semester1Type::class, $semester);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('crud_semester_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('crud_semester/edit.html.twig', [
            'semester' => $semester,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'crud_semester_delete', methods: ['POST'])]
    public function delete(Request $request, Semester $semester, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$semester->getId(), $request->request->get('_token'))) {
            $entityManager->remove($semester);
            $entityManager->flush();
        }

        return $this->redirectToRoute('crud_semester_index', [], Response::HTTP_SEE_OTHER);
    }
}
