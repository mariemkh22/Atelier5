<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BookRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Book;
use App\Form\BookType;
class BookController extends AbstractController

{
    #[Route('/book', name: 'app_book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    #[Route('/showbook', name: 'showbook')]
    public function showdepartement(BookRepository $bookRepository) : Response
    {
        
        $book=$bookRepository->findAll();
    
        return $this->render('book/showbook.html.twig', [
            'book'=>$book
    
    
        ]);
    }
    #[Route('/addbook', name: 'addbook')]
     public function addauthor(ManagerRegistry $managerRegistry,Request $req): Response
     {
        $m=$managerRegistry->getManager();
        $book=new book();
        $form=$this->createForm(BookType::class,$book);
        $form->handleRequest($req);
        if($form->isSubmitted() and $form->isValid()){
          $m->persist($book);
          $m->flush();
          return $this->redirectToRoute('showbook');
        }
        return $this->renderForm('book/addbook.html.twig', [
            'f' => $form
        ]);
       
     }

     #[Route('/editbook/{id}', name: 'editbook')]
     public function editbook($id,BookRepository $BookRepository,Request $req,ManagerRegistry $ManagerRegistry ): Response
     {
         $em = $ManagerRegistry->getManager();
     // var_dump($id).die();
     $dataid=$BookRepository->find($id);
     //var_dump($dataid).die();
     $form=$this->createForm(BookType::class,$dataid);
     $form->handleRequest($req);
     if($form->isSubmitted() and $form->isValid()){
         $em->persist($dataid);
         $em->flush();
        
         return $this->redirectToRoute('showbook');
     }
 
     return $this->renderForm('book/editbook.html.twig', [
         'x'=>$form
         
 
 
     ]);
 }
 #[Route('/deletebook/{id}', name: 'deletebook')]
    public function deletebook($id,BookRepository $BookRepository,Request $req,ManagerRegistry $ManagerRegistry ): Response
    {
        $em = $ManagerRegistry->getManager();
   
    $dataid=$BookRepository->find($id);
    
   
    
        $em->remove($dataid);
        $em->flush();
        return $this->redirectToRoute('showbook');

    }

}
