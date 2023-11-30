<?php

namespace App\Controller;
use App\Form\ChaussureFormType;
use App\Entity\Chaussure;
use App\Repository\ChaussureRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChaussureController extends AbstractController
{
    #[Route('/chaussures', name: 'app_chaussure')]
    public function index(ChaussureRepository $chaussuresRepository ): Response 
    {
        return $this->render('chaussure/liste.html.twig', [
            'controller_name' => 'ChaussureController', 'listeChaussures' => $chaussuresRepository->findAllSortedValues()
        ]);
    }

    #[Route('/chaussures/detail/{id}', name: 'detail_chaussure')]
    public function detail(int $id, ChaussureRepository $chaussureRepository): Response
    {

        $chaussure = $chaussureRepository->findOneBySomeField($id);
        if (!$chaussure) {
            throw $this->createNotFoundException(
                'No chaussure found for id '.$id 
            );
        }
        
        return $this->render('chaussure/detail.html.twig', [
            'chaussure' => $chaussure,
        ]);
    } 

    #[Route('/chaussures/delete/{id}', name: 'delete_chaussure')]
    public function delete(int $id, ChaussureRepository $chaussureRepository, EntityManagerInterface $entityManager): Response
    {

        $chaussure = $chaussureRepository->findOneBySomeField($id);
        if (!$chaussure) {
            throw $this->createNotFoundException(
                'No chaussure found for id '.$id 
            );
        }
        $entityManager->remove($chaussure);
        $entityManager->flush();
        
        return $this->redirectToRoute('app_chaussure');
    }

    #[Route('/chaussures/new', name: 'chaussure_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vetement = new Chaussure();
        $form = $this->createForm(ChaussureFormType::class, $vetement);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $vetement = $form->getData();
            $entityManager->persist($vetement);
            $entityManager->flush();
            return $this->redirectToRoute('app_chaussure');
        }

        return $this->render('chaussure/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
