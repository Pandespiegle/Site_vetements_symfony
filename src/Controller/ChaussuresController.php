<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChaussuresController extends AbstractController
{
    #[Route('/chaussures', name: 'app_chaussures')]
    public function index(): Response
    {
        return $this->render('chaussures/index.html.twig', [
            'controller_name' => 'ChaussuresController',
        ]);
    }
}
