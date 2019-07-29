<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Paquete;
use App\Form\Paquete1Type;
use App\Repository\PaqueteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/paquete")
 * 
 * @IsGranted("ROLE_ANFITRION")
 */
class PaqueteController extends AbstractController
{
    /**
     * @Route("/", name="paquete_index", methods={"GET"})
     */
    public function index(PaqueteRepository $paqueteRepository): Response
    {
        $paquete = new Paquete();
        $id = $this->getUser();
        return $this->render('paquete/index.html.twig', [
            'paquetes' => $paqueteRepository->findUser($id->getId()),
        ]);
    }


    /**
     * @Route("/new", name="paquete_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $paquete = new Paquete();
        $form = $this->createForm(Paquete1Type::class, $paquete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $paquete->setUser($this->getUser());
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
     */
    public function show(Paquete $paquete): Response
    {
        return $this->render('paquete/show.html.twig', [
            'paquete' => $paquete,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="paquete_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Paquete $paquete): Response
    {
        $form = $this->createForm(Paquete1Type::class, $paquete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('paquete_index');
        }

        return $this->render('paquete/edit.html.twig', [
            'paquete' => $paquete,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="paquete_delete", methods={"DELETE"})
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
