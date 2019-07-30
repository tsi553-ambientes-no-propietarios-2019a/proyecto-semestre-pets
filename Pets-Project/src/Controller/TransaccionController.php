<?php

namespace App\Controller;

use App\Entity\Transaccion;
use App\Entity\PagoCliente;
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
     * @IsGranted("ROLE_SUPER_ADMIN")
     * 
     */
    public function index(TransaccionRepository $transaccionRepository): Response
    {
        return $this->render('transaccion/index.html.twig', [
            'transaccions' => $transaccionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="transaccion_new", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function new(Request $request): Response
    {
        $transaccion = new Transaccion();
    
        $id_pay = (int) $_GET['id'];
        $id_pack = (int) $_GET['id_pack'];
        $description = $_GET['product'];
        $monto = (int) $_GET['monto'];

        $repository1 = $this->getDoctrine()->getRepository(PagoCliente::class);
        $pago = $repository1->find($id_pay);
        
        $entityManager = $this->getDoctrine()->getManager();
        $transaccion->setMonto($monto);
        $transaccion->setProducto($description);
        $transaccion->setDivisa('usd');
        $transaccion->setEstado('successfull');
        $transaccion->setCreateAt(new \DateTime("now"));
        $transaccion->setTransaccion($pago);
        $entityManager->persist($transaccion);
        $entityManager->flush();

        return $this->redirectToRoute('cobro_anf_new',[
            'id_trans' => $transaccion->getId(),
            'id_pack' => $id_pack,
        ]);
    }

    /**
     * @Route("/{id}", name="transaccion_show", methods={"GET"})
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function show(Transaccion $transaccion): Response
    {
        return $this->render('transaccion/show.html.twig', [
            'transaccion' => $transaccion,
        ]);
    }

    /**
     * @Route("/{id}", name="transaccion_delete", methods={"DELETE"})
     * @IsGranted("ROLE_SUPER_ADMIN")
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
