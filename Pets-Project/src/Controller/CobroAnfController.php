<?php

namespace App\Controller;

use App\Entity\CobroAnf;
use App\Form\CobroAnfType;
use App\Repository\CobroAnfRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/cobro/anf")
 */
class CobroAnfController extends AbstractController
{
    /**
     * @Route("/", name="cobro_anf_index", methods={"GET"})
     * 
     * Require ROLE_ADMIN for only this controller method.
     * 
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function index(CobroAnfRepository $cobroAnfRepository): Response
    {
        return $this->render('cobro_anf/index.html.twig', [
            'cobro_anfs' => $cobroAnfRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cobro_anf_new", methods={"GET","POST"})
     * 
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function new(Request $request): Response
    {
        $cobroAnf = new CobroAnf();
        $form = $this->createForm(CobroAnfType::class, $cobroAnf);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cobroAnf);
            $entityManager->flush();

            return $this->redirectToRoute('cobro_anf_index');
        }

        return $this->render('cobro_anf/new.html.twig', [
            'cobro_anf' => $cobroAnf,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cobro_anf_show", methods={"GET"})
     * 
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function show(CobroAnf $cobroAnf): Response
    {
        return $this->render('cobro_anf/show.html.twig', [
            'cobro_anf' => $cobroAnf,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cobro_anf_edit", methods={"GET","POST"})
     * 
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function edit(Request $request, CobroAnf $cobroAnf): Response
    {
        $form = $this->createForm(CobroAnfType::class, $cobroAnf);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cobro_anf_index', [
                'id' => $cobroAnf->getId(),
            ]);
        }

        return $this->render('cobro_anf/edit.html.twig', [
            'cobro_anf' => $cobroAnf,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cobro_anf_delete", methods={"DELETE"})
     * 
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function delete(Request $request, CobroAnf $cobroAnf): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cobroAnf->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cobroAnf);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cobro_anf_index');
    }
}
