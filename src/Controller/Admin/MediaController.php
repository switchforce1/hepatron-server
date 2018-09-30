<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Media;
use App\Form\Admin\MediaType;
use App\Model\Admin\MediaFormModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/media")
 */
class MediaController extends Controller
{
    /**
     * @Route("/", name="admin_media_index", methods="GET")
     */
    public function index(): Response
    {
        $media = $this->getDoctrine()
            ->getRepository(Media::class)
            ->findAll();

        return $this->render('Admin/Media/index.html.twig', ['media' => $media]);
    }

    /**
     * @Route("/new", name="admin_media_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $media = new MediaFormModel();
        
        $form = $this->createForm(MediaType::class, $media);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($media);
            $em->flush();

            return $this->redirectToRoute('admin_media_index');
        }

        return $this->render('Admin/Media/new.html.twig', [
            'medium' => $media,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_media_show", methods="GET")
     */
    public function show(Media $media): Response
    {
        return $this->render('Admin/Media/show.html.twig', ['medium' => $media]);
    }

    /**
     * @Route("/{id}/edit", name="admin_media_edit", methods="GET|POST")
     */
    public function edit(Request $request, Media $media): Response
    {
        $form = $this->createForm(MediaType::class, $media);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_media_edit', ['id' => $media->getId()]);
        }

        return $this->render('Admin/Media/edit.html.twig', [
            'medium' => $media,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_media_delete", methods="DELETE")
     */
    public function delete(Request $request, Media $media): Response
    {
        if ($this->isCsrfTokenValid('delete'.$media->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($media);
            $em->flush();
        }

        return $this->redirectToRoute('admin_media_index');
    }
}
