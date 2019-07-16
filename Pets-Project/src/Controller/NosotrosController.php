<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NosotrosController extends AbstractController
{
    /**
     * @Route("/nosotros", name="nosotros")
     */
    public function index()
    {
        return $this->render('nosotros/index.html.twig', [
            'controller_name' => 'NosotrosController',
        ]);
    }
}
