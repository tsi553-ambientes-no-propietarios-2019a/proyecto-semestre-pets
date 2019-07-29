<?php

namespace App\Controller;

use App\Repository\PaqueteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class BuyConfirmController extends AbstractController
{
    /**
     * @Route("/buy/confirm", name="buy_confirm")
     */
    public function index()
    {
        return $this->render('buy_confirm/index.html.twig', [
            'controller_name' => 'BuyConfirmController',
        ]);
    }

    /**
     * @Route("/disponibles", name="buy")
     * 
     * @IsGranted("ROLE_USER") 
     */
    public function buy(PaqueteRepository $paqueteRepository): Response
    {
        return $this->render('buy_confirm/disponibles.html.twig', [
            'paquetes' => $paqueteRepository->findAll(),
        ]);
    }

}
