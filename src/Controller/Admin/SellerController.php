<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Seller;
use App\Form\Admin\SellerType;
use App\Repository\Admin\SellerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/seller")
 */
class SellerController extends Controller
{
    /**
     * @Route("/", name="admin_seller_index", methods="GET")
     */
    public function index(SellerRepository $sellerRepository): Response
    {
        return $this->render('Admin/Seller/index.html.twig', ['sellers' => $sellerRepository->findAll()]);
    }

    /**
     * @Route("/new", name="admin_seller_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $seller = new Seller();
        $form = $this->createForm(SellerType::class, $seller);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($seller);
            $em->flush();

            return $this->redirectToRoute('admin_seller_index');
        }

        return $this->render('Admin/Seller/new.html.twig', [
            'seller' => $seller,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_seller_show", methods="GET")
     */
    public function show(Seller $seller): Response
    {
        return $this->render('Admin/Seller/show.html.twig', ['seller' => $seller]);
    }

    /**
     * @Route("/{id}/edit", name="admin_seller_edit", methods="GET|POST")
     */
    public function edit(Request $request, Seller $seller): Response
    {
        $form = $this->createForm(SellerType::class, $seller);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_seller_edit', ['id' => $seller->getId()]);
        }

        return $this->render('Admin/Seller/edit.html.twig', [
            'seller' => $seller,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_seller_delete", methods="DELETE")
     */
    public function delete(Request $request, Seller $seller): Response
    {
        if ($this->isCsrfTokenValid('delete'.(int)$seller->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($seller);
            $em->flush();
        }

        return $this->redirectToRoute('admin_seller_index');
    }
}
