<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Mannequin;
use App\Form\Admin\MannequinType;
use App\Repository\Admin\MannequinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/mannequin")
 */
class MannequinController extends Controller
{
    /**
     * @Route("/", name="admin_mannequin_index", methods="GET")
     */
    public function index(MannequinRepository $mannequinRepository): Response
    {
        return $this->render('Admin/mannequin/index.html.twig', ['mannequins' => $mannequinRepository->findAll()]);
    }

    /**
     * @Route("/new", name="admin_mannequin_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $mannequin = new Mannequin();
        $form = $this->createForm(MannequinType::class, $mannequin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mannequin);
            $em->flush();

            return $this->redirectToRoute('admin_mannequin_index');
        }

        return $this->render('Admin/mannequin/new.html.twig', [
            'mannequin' => $mannequin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_mannequin_show", methods="GET")
     */
    public function show(Mannequin $mannequin): Response
    {
        return $this->render('Admin/mannequin/show.html.twig', ['mannequin' => $mannequin]);
    }

    /**
     * @Route("/{id}/edit", name="admin_mannequin_edit", methods="GET|POST")
     */
    public function edit(Request $request, Mannequin $mannequin): Response
    {
        $form = $this->createForm(MannequinType::class, $mannequin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_mannequin_edit', ['id' => $mannequin->getId()]);
        }

        return $this->render('Admin/mannequin/edit.html.twig', [
            'mannequin' => $mannequin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_mannequin_delete", methods="DELETE")
     */
    public function delete(Request $request, Mannequin $mannequin): Response
    {
        if ($this->isCsrfTokenValid('delete'.(int)$mannequin->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($mannequin);
            $em->flush();
        }

        return $this->redirectToRoute('admin_mannequin_index');
    }
}
