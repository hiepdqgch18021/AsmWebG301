<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassRoomController extends AbstractController
{
    #[Route('/class/room', name: 'class_room')]
    public function index(): Response
    {
        return $this->render('class_room/index.html.twig', [
            'controller_name' => 'ClassRoomController',
        ]);
    }
}
