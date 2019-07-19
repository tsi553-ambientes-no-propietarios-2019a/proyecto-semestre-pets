<?php

namespace App\Controller;

use App\Entity\Anfitrion;
use App\Form\AnfitrionType;
use App\Repository\AnfitrionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/anfitrion")
 */
class AnfitrionController extends AbstractController
{
    /**
     * @Route("/", name="anfitrion_index", methods={"GET"})
     * 
     * Require ROLE_ANFITRION for only this controller method.
     * 
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function index(AnfitrionRepository $anfitrionRepository): Response
    {
        return $this->render('anfitrion/index.html.twig', [
            'anfitrions' => $anfitrionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="anfitrion_new", methods={"GET","POST"})
     * 
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function new(Request $request): Response
    {
        $anfitrion = new Anfitrion();
        $form = $this->createForm(AnfitrionType::class, $anfitrion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($anfitrion);
            $entityManager->flush();

            return $this->redirectToRoute('anfitrion_index');
        }

        return $this->render('anfitrion/new.html.twig', [
            'anfitrion' => $anfitrion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="anfitrion_show", methods={"GET"})
     * 
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function show(Anfitrion $anfitrion): Response
    {
        return $this->render('anfitrion/show.html.twig', [
            'anfitrion' => $anfitrion,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="anfitrion_edit", methods={"GET","POST"})
     * 
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function edit(Request $request, Anfitrion $anfitrion): Response
    {
        $form = $this->createForm(AnfitrionType::class, $anfitrion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('anfitrion_index', [
                'id' => $anfitrion->getId(),
            ]);
        }

        return $this->render('anfitrion/edit.html.twig', [
            'anfitrion' => $anfitrion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="anfitrion_delete", methods={"DELETE"})
     * 
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function delete(Request $request, Anfitrion $anfitrion): Response
    {
        if ($this->isCsrfTokenValid('delete'.$anfitrion->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($anfitrion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('anfitrion_index');
    }
}
