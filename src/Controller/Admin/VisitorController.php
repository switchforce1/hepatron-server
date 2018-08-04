<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Visitor;
use App\Form\Admin\VisitorType;
use App\Repository\Admin\VisitorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/visitor")
 */
class VisitorController extends Controller
{
    /**
     * @Route("/", name="admin_visitor_index", methods="GET")
     */
    public function index(VisitorRepository $visitorRepository): Response
    {
        return $this->render('admin_visitor/index.html.twig', ['visitors' => $visitorRepository->findAll()]);
    }

    /**
     * @Route("/new", name="admin_visitor_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $visitor = new Visitor();
        $form = $this->createForm(VisitorType::class, $visitor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($visitor);
            $em->flush();

            return $this->redirectToRoute('admin_visitor_index');
        }

        return $this->render('admin_visitor/new.html.twig', [
            'visitor' => $visitor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_visitor_show", methods="GET")
     */
    public function show(Visitor $visitor): Response
    {
        return $this->render('admin_visitor/show.html.twig', ['visitor' => $visitor]);
    }

    /**
     * @Route("/{id}/edit", name="admin_visitor_edit", methods="GET|POST")
     */
    public function edit(Request $request, Visitor $visitor): Response
    {
        $form = $this->createForm(VisitorType::class, $visitor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_visitor_edit', ['id' => $visitor->getId()]);
        }

        return $this->render('admin_visitor/edit.html.twig', [
            'visitor' => $visitor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_visitor_delete", methods="DELETE")
     */
    public function delete(Request $request, Visitor $visitor): Response
    {
        if ($this->isCsrfTokenValid('delete'.$visitor->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($visitor);
            $em->flush();
        }

        return $this->redirectToRoute('admin_visitor_index');
    }
}
