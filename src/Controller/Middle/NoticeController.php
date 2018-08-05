<?php

namespace App\Controller\Middle;

use App\Entity\Middle\Notice;
use App\Form\Middle\NoticeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/middle/notice")
 */
class NoticeController extends Controller
{
    /**
     * @Route("/", name="middle_notice_index", methods="GET")
     */
    public function index(): Response
    {
        $notices = $this->getDoctrine()
            ->getRepository(Notice::class)
            ->findAll();

        return $this->render('Middle/Notice/index.html.twig', ['notices' => $notices]);
    }

    /**
     * @Route("/new", name="middle_notice_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $notice = new Notice();
        $form = $this->createForm(NoticeType::class, $notice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($notice);
            $em->flush();

            return $this->redirectToRoute('middle_notice_index');
        }

        return $this->render('Middle/Notice/new.html.twig', [
            'notice' => $notice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="middle_notice_show", methods="GET")
     */
    public function show(Notice $notice): Response
    {
        return $this->render('Middle/Notice/show.html.twig', ['notice' => $notice]);
    }

    /**
     * @Route("/{id}/edit", name="middle_notice_edit", methods="GET|POST")
     */
    public function edit(Request $request, Notice $notice): Response
    {
        $form = $this->createForm(NoticeType::class, $notice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('middle_notice_edit', ['id' => $notice->getId()]);
        }

        return $this->render('Middle/Notice/edit.html.twig', [
            'notice' => $notice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="middle_notice_delete", methods="DELETE")
     */
    public function delete(Request $request, Notice $notice): Response
    {
        if ($this->isCsrfTokenValid('delete'.$notice->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($notice);
            $em->flush();
        }

        return $this->redirectToRoute('middle_notice_index');
    }
}
