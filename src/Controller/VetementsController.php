<?php

namespace App\Controller;

use App\Repository\VetementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Vetement;
use App\Form\VetementFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VetementsController extends AbstractController
{
    #[Route('/vetements', name: 'app_vetements')]
    public function index(VetementRepository $vetementRepository): Response
    {

        return $this->render('vetements/index.html.twig', [
            'controller_name' => 'VetementsController', 'listeVetements' => $vetementRepository->findAll()
        ]);
    }

    #[Route('/vetements/new', name: 'app_vetements_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // creates a task object and initializes some data for this example
        $vetement = new Vetement();
        $form = $this->createForm(VetementFormType::class, $vetement);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $vetement = $form->getData();
            var_dump($vetement);
            $entityManager->persist($vetement);
            $entityManager->flush();
            return $this->redirectToRoute('app_vetements');
        }

        return $this->render('vetements/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/vetements/detail/{id}', name: 'detail_vetement')]
    public function detail(int $id, VetementRepository $vetementRepository): Response
    {

        $vetement = $vetementRepository->findOneBySomeField($id);
        if (!$vetement) {
            throw $this->createNotFoundException(
                'No vetement found for id '.$id
            );
        }
        
        return $this->render('vetements/detail.html.twig', [
            'vetement' => $vetement,
        ]);
    } 
    
}
