<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AuthorType;
use App\Form\SearchType;
use App\Form\MinmaxType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Author;


class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }
    #[Route('/showauthor', name: 'showauthor')]
    public function showauthor(AuthorRepository $authorRepository, Request $req) : Response
    {
        
        //$author=$authorRepository->findAll();
        $form=$this->createForm(SearchType::class);
        $form->handleRequest($req);

        if  ($form->isSubmitted()){
            
          // $datainput=$form->get('username')->getData();
           $min= $form->get('min')->getData();
           $max= $form->get('max')->getData();
            //var_dump($datainput).die();
             // $author=$authorRepository->orderbyusername();
   //$author=$authorRepository->searchByalphabet();
//$authors =$authorRepository->searchbyusername($datainput);
//$author =$authorRepository->searchbyusername($datainput);
            $authors =$authorRepository->minmax($min,$max);
        return $this->render('author/showauthor.html.twig', [
            'author'=>$authors,
            'f'=>$form
    
    
        ]);
    }
    $authors = $authorRepository->findAllOrderByEmail();

    return $this->render('auteur/liste_par_email.html.twig', [
        'auteurs' => $authors,
    ]);
}

    #[Route('/addauthor', name: 'addauthor')]
     public function addauthor(ManagerRegistry $managerRegistry,Request $req): Response
     {
        $m=$managerRegistry->getManager();
        $author=new author();
        $form=$this->createForm(AuthorType::class,$author);
        $form->handleRequest($req);
        if($form->isSubmitted() and $form->isValid()){
          $m->persist($author);
          $m->flush();
          return $this->redirectToRoute('showauthor');
        }
        return $this->renderForm('author/addauthor.html.twig', [
            'f' => $form
        ]);
       
     }
     #[Route('/editauthor/{id}', name: 'editauthor')]
     public function editauthor($id,authorRepository $AuthorRepository,Request $req,ManagerRegistry $ManagerRegistry ): Response
     {
         $em = $ManagerRegistry->getManager();
     // var_dump($id).die();
     $dataid=$AuthorRepository->find($id);
     //var_dump($dataid).die();
     $form=$this->createForm(AuthorType::class,$dataid);
     $form->handleRequest($req);
     if($form->isSubmitted() and $form->isValid()){
         $em->persist($dataid);
         $em->flush();
        
         return $this->redirectToRoute('showauthor');
     }
 
     return $this->renderForm('author/editauthor.html.twig', [
         'x'=>$form
         
 
 
     ]);
 }
 #[Route('/deleteauthor/{id}', name: 'deleteauthor')]
    public function deleteauthor($id,AuthorRepository $authorRepository,Request $req,ManagerRegistry $ManagerRegistry ): Response
    {
        $em = $ManagerRegistry->getManager();
   
    $dataid=$authorRepository->find($id);
    
   
    
        $em->remove($dataid);
        $em->flush();
        return $this->redirectToRoute('showauthor');

    }

}
