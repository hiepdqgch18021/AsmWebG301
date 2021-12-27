<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Json;

class SemesterController extends AbstractController
{

/**
 * @Route("/semesters/api" , methods={"GET"},name="semester_api")
 */ 
public function semesterAPI(): JsonResponse{
    $semesters = $this-> getDoctrine()->getRepository(Semester::class)->findAll();
        return $this -> json(['semesters' => $semesters],200);
    }

/**
 * @Route("/semesters" ,name="semester_index")
 */ 
public function semesterIndex(){
    $semesters = $this-> getDoctrine()->getRepository(Semester::class)->findAll();
        return $this -> render ("semester/index.html.twig",
        [
            'semesters' => $semesters
        ]) ;
    }  
    
/**
 * @Route("/semester/{id}" ,name="semester_detail")
 */ 
public function semesterDetail($id){
$semester = $this->getDoctrine()->getRepository(Semester::class)->find($id);
return $this -> render("semester/detail.html.twig",
[
    "semester" => $semester
]);
}
/**
 * @Route("/semester/delete/{id}" ,name="semester_delete")
 */ 
public function semesterDelete($id){
    
}

/**
 * @Route("/semester/add" ,name="semester_add")
 */ 
public function semesterAdd(Request $request){

    
}

/**
 * @Route("/semester/edit/{id}" ,name="semester_edit")
 */ 
public function semesterEdit(Request $request,$id){
    
}

}
