<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class AyudaController extends AbstractController
{
    /**
     * @Route("/ayuda", name="ayuda")
     */
    public function index()
    {
        return $this->render('ayuda/index.html.twig', [
            'controller_name' => 'AyudaController',
        ]);
    }
}
