<?php

namespace App\Controller;

use App\Entity\Valorizacion;
use App\Form\ValorizacionType;
use App\Repository\ValorizacionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/valorizacion")
 */
class ValorizacionController extends AbstractController
{
    /**
     * @Route("/", name="valorizacion_index", methods={"GET"})
     */
    public function index(ValorizacionRepository $valorizacionRepository): Response
    {
        return $this->render('valorizacion/index.html.twig', [
            'valorizacions' => $valorizacionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="valorizacion_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $valorizacion = new Valorizacion();
        $form = $this->createForm(ValorizacionType::class, $valorizacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($valorizacion);
            $entityManager->flush();

            return $this->redirectToRoute('valorizacion_index');
        }

        return $this->render('valorizacion/new.html.twig', [
            'valorizacion' => $valorizacion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="valorizacion_show", methods={"GET"})
     */
    public function show(Valorizacion $valorizacion): Response
    {
        return $this->render('valorizacion/show.html.twig', [
            'valorizacion' => $valorizacion,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="valorizacion_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Valorizacion $valorizacion): Response
    {
        $form = $this->createForm(ValorizacionType::class, $valorizacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('valorizacion_index');
        }

        return $this->render('valorizacion/edit.html.twig', [
            'valorizacion' => $valorizacion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="valorizacion_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Valorizacion $valorizacion): Response
    {
        if ($this->isCsrfTokenValid('delete'.$valorizacion->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($valorizacion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('valorizacion_index');
    }
}
