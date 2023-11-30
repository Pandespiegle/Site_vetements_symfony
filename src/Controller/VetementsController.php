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

        return $this->render('vetement/liste.html.twig', [
            'controller_name' => 'VetementsController', 'listeVetements' => $vetementRepository->findAll()
        ]);
    }

    #[Route('/vetements/new', name: 'vetements_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vetement = new Vetement();
        $form = $this->createForm(VetementFormType::class, $vetement);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $vetement = $form->getData();
            $entityManager->persist($vetement);
            $entityManager->flush();
            return $this->redirectToRoute('app_vetements');
        }

        return $this->render('vetement/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/vetement/delete/{id}', name: 'delete_vetement')]
    public function delete(int $id, VetementRepository $vetmementRepository, EntityManagerInterface $entityManager): Response
    {

        $vetement = $vetmementRepository->findOneBySomeField($id);
        if (!$vetement) {
            throw $this->createNotFoundException(
                'No vetement found for id '.$id 
            );
        }
        $entityManager->remove($vetement);
        $entityManager->flush();
        
        return $this->redirectToRoute('app_vetements');
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
        
        return $this->render('vetement/detail.html.twig', [
            'vetement' => $vetement,
        ]);
    } 
    
}
