<?php

namespace App\Controller;

use App\Entity\Mascota;
use App\Form\MascotaType;
use App\Repository\MascotaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mascota")
 */
class MascotaController extends AbstractController
{
    /**
     * @Route("/", name="mascota_index", methods={"GET"})
     */
    public function index(MascotaRepository $mascotaRepository): Response
    {
        return $this->render('mascota/index.html.twig', [
            'mascotas' => $mascotaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="mascota_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $mascotum = new Mascota();
        $form = $this->createForm(MascotaType::class, $mascotum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mascotum);
            $entityManager->flush();

            return $this->redirectToRoute('mascota_index');
        }

        return $this->render('mascota/new.html.twig', [
            'mascotum' => $mascotum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mascota_show", methods={"GET"})
     */
    public function show(Mascota $mascotum): Response
    {
        return $this->render('mascota/show.html.twig', [
            'mascotum' => $mascotum,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="mascota_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Mascota $mascotum): Response
    {
        $form = $this->createForm(MascotaType::class, $mascotum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mascota_index', [
                'id' => $mascotum->getId(),
            ]);
        }

        return $this->render('mascota/edit.html.twig', [
            'mascotum' => $mascotum,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mascota_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Mascota $mascotum): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mascotum->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mascotum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mascota_index');
    }
}
