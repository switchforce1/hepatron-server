<?php

namespace App\Controller\Middle;

use App\Entity\Middle\Shooting;
use App\Form\Middle\ShootingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/middle/shooting")
 */
class ShootingController extends Controller
{
    /**
     * @Route("/", name="middle_shooting_index", methods="GET")
     */
    public function index(): Response
    {
        $shootings = $this->getDoctrine()
            ->getRepository(Shooting::class)
            ->findAll();

        return $this->render('Middle/Shooting/index.html.twig', ['shootings' => $shootings]);
    }

    /**
     * @Route("/new", name="middle_shooting_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $shooting = new Shooting();
        $form = $this->createForm(ShootingType::class, $shooting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($shooting);
            $em->flush();

            return $this->redirectToRoute('middle_shooting_index');
        }

        return $this->render('Middle/Shooting/new.html.twig', [
            'shooting' => $shooting,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="middle_shooting_show", methods="GET")
     */
    public function show(Shooting $shooting): Response
    {
        return $this->render('Middle/Shooting/show.html.twig', ['shooting' => $shooting]);
    }

    /**
     * @Route("/{id}/edit", name="middle_shooting_edit", methods="GET|POST")
     */
    public function edit(Request $request, Shooting $shooting): Response
    {
        $form = $this->createForm(ShootingType::class, $shooting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('middle_shooting_edit', ['id' => $shooting->getId()]);
        }

        return $this->render('Middle/Shooting/edit.html.twig', [
            'shooting' => $shooting,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="middle_shooting_delete", methods="DELETE")
     */
    public function delete(Request $request, Shooting $shooting): Response
    {
        if ($this->isCsrfTokenValid('delete'.$shooting->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($shooting);
            $em->flush();
        }

        return $this->redirectToRoute('middle_shooting_index');
    }
}
