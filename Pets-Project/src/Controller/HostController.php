<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\HostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * 
 * @IsGranted("ROLE_USER")
 * 
 */

class HostController extends AbstractController
{
    /**
     * @Route("/host", name="host"), methods={"POST"})
     */

    public function edit(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(HostType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRoles(['ROLE_USER', 'ROLE_ANFITRION']);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fos_user_security_logout', [
                'id' => $user->getId(),
            ]);
        }

        return $this->render('host/index.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
