<?php

namespace App\Controller;

use App\Entity\PagoCliente;
use App\Form\PagoClienteType;
use App\Repository\PagoClienteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/pago/cliente")
 * 
 * @IsGranted("ROLE_USER")
 * 
 */
class PagoClienteController extends AbstractController
{
    /**
     * @Route("/", name="pago_cliente_index", methods={"GET"})
     */
    public function index(PagoClienteRepository $pagoClienteRepository): Response
    {
        return $this->render('pago_cliente/index.html.twig', [
            'pago_clientes' => $pagoClienteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="pago_cliente_new", methods={"GET","POST"}) 
     */
    public function new(Request $request): Response
    {
        $pagoCliente = new PagoCliente();
        $id_select_produc = $_GET['id'];
        
        $form = $this->createForm(PagoClienteType::class, $pagoCliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $pagoCliente->setCreateAt(new \DateTime("now"));
            $entityManager->persist($pagoCliente);
            $entityManager->flush();

            return $this->redirectToRoute('servicio_new',[
                'idpago'=> $pagoCliente->getId(),
                'idpaq'=> $id_select_produc,
            ]);
        }

        return $this->render('pago_cliente/new.html.twig', [
            'pago_cliente' => $pagoCliente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pago_cliente_show", methods={"GET"})
     */
    public function show(PagoCliente $pagoCliente): Response
    {
        return $this->render('pago_cliente/show.html.twig', [
            'pago_cliente' => $pagoCliente,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pago_cliente_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PagoCliente $pagoCliente): Response
    {
        $form = $this->createForm(PagoClienteType::class, $pagoCliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pago_cliente_index', [
                'id' => $pagoCliente->getId(),
            ]);
        }

        return $this->render('pago_cliente/edit.html.twig', [
            'pago_cliente' => $pagoCliente,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pago_cliente_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PagoCliente $pagoCliente): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pagoCliente->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pagoCliente);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pago_cliente_index');
    }
}
