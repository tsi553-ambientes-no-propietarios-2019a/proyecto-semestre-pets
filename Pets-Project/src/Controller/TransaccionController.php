<?php

namespace App\Controller;

use App\Entity\Transaccion;
use App\Form\TransaccionType;
use App\Repository\TransaccionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/transaccion")
 */
class TransaccionController extends AbstractController
{
    /**
     * @Route("/", name="transaccion_index", methods={"GET"})
     * 
     * Require ROLE_ADMIN for only this controller method.
     * 
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function index(TransaccionRepository $transaccionRepository): Response
    {
        return $this->render('transaccion/index.html.twig', [
            'transaccions' => $transaccionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="transaccion_new", methods={"GET","POST"})
     * 
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function new(Request $request): Response
    {
        $transaccion = new Transaccion();
        $form = $this->createForm(TransaccionType::class, $transaccion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($transaccion);
            $entityManager->flush();

            return $this->redirectToRoute('transaccion_index');
        }

        return $this->render('transaccion/new.html.twig', [
            'transaccion' => $transaccion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="transaccion_show", methods={"GET"})
     * 
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function show(Transaccion $transaccion): Response
    {
        return $this->render('transaccion/show.html.twig', [
            'transaccion' => $transaccion,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="transaccion_edit", methods={"GET","POST"})
     * 
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function edit(Request $request, Transaccion $transaccion): Response
    {
        $form = $this->createForm(TransaccionType::class, $transaccion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('transaccion_index', [
                'id' => $transaccion->getId(),
            ]);
        }

        return $this->render('transaccion/edit.html.twig', [
            'transaccion' => $transaccion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="transaccion_delete", methods={"DELETE"})
     * 
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function delete(Request $request, Transaccion $transaccion): Response
    {
        if ($this->isCsrfTokenValid('delete'.$transaccion->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($transaccion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('transaccion_index');
    }
}
