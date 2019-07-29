<?php

namespace App\Controller;

use App\Entity\Paquete;
use App\Repository\PaqueteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home") methods={"GET"})
     */
    public function index(PaqueteRepository $paqueteRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'paquetes' => $paqueteRepository->findAll(),
        ]);
    }
}
