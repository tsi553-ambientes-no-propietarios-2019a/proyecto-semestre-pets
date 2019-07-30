<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\CobroAnf;
use App\Entity\Paquete;
use App\Entity\Transaccion;
use App\Form\CobroAnfType;
use App\Repository\CobroAnfRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/cobro/anf") * 
 */
class CobroAnfController extends AbstractController
{
    /**
     * @Route("/", name="cobro_anf_index", methods={"GET"})
     * 
     * @IsGranted("ROLE_ANFITRION")
     * 
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
     * @IsGranted("ROLE_USER")
     * 
     */
    public function new(Request $request): Response
    {
        $cobroAnf = new CobroAnf();

        $id_pack = (int) $_GET['id_pack'];
        $id_tras = (int) $_GET['id_trans'];
        $repository = $this->getDoctrine()->getRepository(Paquete::class);
        $paquete = $repository->find($id_pack);

        $repository1 = $this->getDoctrine()->getRepository(Transaccion::class);
        $transaccion = $repository1->find($id_tras);

        // operacion de comision
        $comision = (int) $paquete->getPrecio() * 0.80;
        $aux = (string) $comision;
        // llamar a objeto usario
        $user = $paquete->getUser();

        $entityManager = $this->getDoctrine()->getManager();
        $cobroAnf->setUser($user);
        $cobroAnf->setIdTransaccion($transaccion);
        $cobroAnf->setComision($aux);
        $entityManager->persist($cobroAnf);
        $entityManager->flush();

         return $this->redirectToRoute('buy_confirm');
        
    }

    /**
     * @Route("/{id}", name="cobro_anf_show", methods={"GET"})
     * 
     * @IsGranted("ROLE_ANFITRION")
     */
    public function show(CobroAnf $cobroAnf): Response
    {
        return $this->render('cobro_anf/show.html.twig', [
            'cobro_anf' => $cobroAnf,
        ]);
    }

    /**
     * @Route("/{id}", name="cobro_anf_delete", methods={"DELETE"})
     * 
     * @IsGranted("ROLE_SUPER_ADMIN")
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
