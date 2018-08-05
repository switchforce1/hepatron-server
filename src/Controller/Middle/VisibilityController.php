<?php

namespace App\Controller\Middle;

use App\Entity\Middle\Visibility;
use App\Form\Middle\VisibilityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/middle/visibility")
 */
class VisibilityController extends Controller
{
    /**
     * @Route("/", name="middle_visibility_index", methods="GET")
     */
    public function index(): Response
    {
        $visibilities = $this->getDoctrine()
            ->getRepository(Visibility::class)
            ->findAll();

        return $this->render('Middle/Visibility/index.html.twig', ['visibilities' => $visibilities]);
    }

    /**
     * @Route("/new", name="middle_visibility_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $visibility = new Visibility();
        $form = $this->createForm(VisibilityType::class, $visibility);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($visibility);
            $em->flush();

            return $this->redirectToRoute('middle_visibility_index');
        }

        return $this->render('Middle/Visibility/new.html.twig', [
            'visibility' => $visibility,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="middle_visibility_show", methods="GET")
     */
    public function show(Visibility $visibility): Response
    {
        return $this->render('Middle/Visibility/show.html.twig', ['visibility' => $visibility]);
    }

    /**
     * @Route("/{id}/edit", name="middle_visibility_edit", methods="GET|POST")
     */
    public function edit(Request $request, Visibility $visibility): Response
    {
        $form = $this->createForm(VisibilityType::class, $visibility);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('middle_visibility_edit', ['id' => $visibility->getId()]);
        }

        return $this->render('Middle/Visibility/edit.html.twig', [
            'visibility' => $visibility,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="middle_visibility_delete", methods="DELETE")
     */
    public function delete(Request $request, Visibility $visibility): Response
    {
        if ($this->isCsrfTokenValid('delete'.$visibility->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($visibility);
            $em->flush();
        }

        return $this->redirectToRoute('middle_visibility_index');
    }
}
