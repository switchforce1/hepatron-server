<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Partnership;
use App\Form\Admin\PartnershipType;
use App\Repository\Admin\PartnershipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/partnership")
 */
class PartnershipController extends Controller
{
    /**
     * @Route("/", name="admin_partnership_index", methods="GET")
     */
    public function index(PartnershipRepository $partnershipRepository): Response
    {
        return $this->render('Admin/partnership/index.html.twig', ['partnerships' => $partnershipRepository->findAll()]);
    }

    /**
     * @Route("/new", name="admin_partnership_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $partnership = new Partnership();
        $form = $this->createForm(PartnershipType::class, $partnership);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($partnership);
            $em->flush();

            return $this->redirectToRoute('admin_partnership_index');
        }

        return $this->render('Admin/partnership/new.html.twig', [
            'partnership' => $partnership,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_partnership_show", methods="GET")
     */
    public function show(Partnership $partnership): Response
    {
        return $this->render('Admin/partnership/show.html.twig', ['partnership' => $partnership]);
    }

    /**
     * @Route("/{id}/edit", name="admin_partnership_edit", methods="GET|POST")
     */
    public function edit(Request $request, Partnership $partnership): Response
    {
        $form = $this->createForm(PartnershipType::class, $partnership);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_partnership_edit', ['id' => $partnership->getId()]);
        }

        return $this->render('Admin/partnership/edit.html.twig', [
            'partnership' => $partnership,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_partnership_delete", methods="DELETE")
     */
    public function delete(Request $request, Partnership $partnership): Response
    {
        if ($this->isCsrfTokenValid('delete'.(int)$partnership->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($partnership);
            $em->flush();
        }

        return $this->redirectToRoute('admin_partnership_index');
    }
}
