<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Tailor;
use App\Form\Admin\TailorType;
use App\Repository\Admin\TailorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/tailor")
 */
class TailorController extends Controller
{
    /**
     * @Route("/", name="admin_tailor_index", methods="GET")
     */
    public function index(TailorRepository $tailorRepository): Response
    {
        return $this->render('admin_tailor/index.html.twig', ['tailors' => $tailorRepository->findAll()]);
    }

    /**
     * @Route("/new", name="admin_tailor_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $tailor = new Tailor();
        $form = $this->createForm(TailorType::class, $tailor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tailor);
            $em->flush();

            return $this->redirectToRoute('admin_tailor_index');
        }

        return $this->render('admin_tailor/new.html.twig', [
            'tailor' => $tailor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_tailor_show", methods="GET")
     */
    public function show(Tailor $tailor): Response
    {
        return $this->render('admin_tailor/show.html.twig', ['tailor' => $tailor]);
    }

    /**
     * @Route("/{id}/edit", name="admin_tailor_edit", methods="GET|POST")
     */
    public function edit(Request $request, Tailor $tailor): Response
    {
        $form = $this->createForm(TailorType::class, $tailor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_tailor_edit', ['id' => $tailor->getId()]);
        }

        return $this->render('admin_tailor/edit.html.twig', [
            'tailor' => $tailor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_tailor_delete", methods="DELETE")
     */
    public function delete(Request $request, Tailor $tailor): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tailor->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tailor);
            $em->flush();
        }

        return $this->redirectToRoute('admin_tailor_index');
    }
}
