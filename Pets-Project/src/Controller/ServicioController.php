<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Paquete;
use App\Entity\PagoCliente;
use App\Entity\Servicio;
use App\Form\ServicioType;
use App\Repository\ServicioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/servicio")
 */
class ServicioController extends AbstractController
{
    /**
     * @Route("/", name="servicio_index", methods={"GET"})
     * 
     * @IsGranted("ROLE_USER")
     */
    public function index(ServicioRepository $servicioRepository): Response
    {
        $id = $this->getUser();

        return $this->render('servicio/index.html.twig', [
            'servicios' => $servicioRepository->findUser($id->getId()),
        ]);
    }

    /**
     * @Route("/new", name="servicio_new", methods={"GET","POST"})
     * 
     * @IsGranted("ROLE_USER")
     */
    public function new(Request $request): Response
    {
        $servicio = new Servicio();

        $id_select_package = (int) $_GET['idpaq'];
        $id_select_pay = (int) $_GET['idpago'];
        
        $repository = $this->getDoctrine()->getRepository(Paquete::class);
        $repository1 = $this->getDoctrine()->getRepository(PagoCliente::class);

        $id_paquete = $repository->find($id_select_package);
        $ip_pago = $repository1->find($id_select_pay);

        $form = $this->createForm(ServicioType::class, $servicio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $servicio->setUser($this->getUser());
            $servicio->setPagoCliente($ip_pago);
            $servicio->setServicioPaquete($id_paquete);

            $entityManager->persist($servicio);
            $entityManager->flush();

            return $this->redirectToRoute('buy_confirm');
        }

        return $this->render('servicio/new.html.twig', [
            'servicio' => $servicio,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="servicio_show", methods={"GET"})
     * 
     * @IsGranted("ROLE_USER")
     */
    public function show(Servicio $servicio): Response
    {
        return $this->render('servicio/show.html.twig', [
            'servicio' => $servicio,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="servicio_edit", methods={"GET","POST"})
     * 
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Servicio $servicio): Response
    {
        $form = $this->createForm(ServicioType::class, $servicio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('servicio_index', [
                'id' => $servicio->getId(),
            ]);
        }

        return $this->render('servicio/edit.html.twig', [
            'servicio' => $servicio,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="servicio_delete", methods={"DELETE"})
     * 
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Servicio $servicio): Response
    {
        if ($this->isCsrfTokenValid('delete'.$servicio->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($servicio);
            $entityManager->flush();
        }

        return $this->redirectToRoute('servicio_index');
    }

}
