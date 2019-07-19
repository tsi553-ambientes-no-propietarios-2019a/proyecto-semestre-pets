<?php

namespace App\Controller;

use App\Entity\Paquete;
use App\Form\PaqueteType;
use App\Repository\PaqueteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/paquete")
 */
class PaqueteController extends AbstractController
{
    /**
     * @Route("/", name="paquete_index", methods={"GET"})
     * 
     * Require ROLE_ANFITRION for only this controller method.
     * 
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function index(PaqueteRepository $paqueteRepository): Response
    {
        return $this->render('paquete/index.html.twig', [
            'paquetes' => $paqueteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="paquete_new", methods={"GET","POST"})
     * 
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function new(Request $request): Response
    {
        $paquete = new Paquete();
        $form = $this->createForm(PaqueteType::class, $paquete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($paquete);
            $entityManager->flush();

            return $this->redirectToRoute('paquete_index');
        }

        return $this->render('paquete/new.html.twig', [
            'paquete' => $paquete,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="paquete_show", methods={"GET"})
     * 
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function show(Paquete $paquete): Response
    {
        return $this->render('paquete/show.html.twig', [
            'paquete' => $paquete,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="paquete_edit", methods={"GET","POST"})
     * 
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function edit(Request $request, Paquete $paquete): Response
    {
        $form = $this->createForm(PaqueteType::class, $paquete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('paquete_index', [
                'id' => $paquete->getId(),
            ]);
        }

        return $this->render('paquete/edit.html.twig', [
            'paquete' => $paquete,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="paquete_delete", methods={"DELETE"})
     * 
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function delete(Request $request, Paquete $paquete): Response
    {
        if ($this->isCsrfTokenValid('delete'.$paquete->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($paquete);
            $entityManager->flush();
        }

        return $this->redirectToRoute('paquete_index');
    }
}
