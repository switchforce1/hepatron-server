<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Image;
use App\Form\Admin\ImageType;
use App\Repository\Admin\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/image")
 */
class ImageController extends Controller
{
    /**
     * @Route("/", name="admin_image_index", methods="GET")
     */
    public function index(ImageRepository $imageRepository): Response
    {
        return $this->render('Admin/Image/index.html.twig', ['images' => $imageRepository->findAll()]);
    }

    /**
     * @Route("/new", name="admin_image_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($image);
            $em->flush();

            return $this->redirectToRoute('admin_image_index');
        }

        return $this->render('Admin/Image/new.html.twig', [
            'image' => $image,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_image_show", methods="GET")
     */
    public function show(Image $image): Response
    {
        return $this->render('Admin/Image/show.html.twig', ['image' => $image]);
    }

    /**
     * @Route("/{id}/edit", name="admin_image_edit", methods="GET|POST")
     */
    public function edit(Request $request, Image $image): Response
    {
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_image_edit', ['id' => $image->getId()]);
        }

        return $this->render('Admin/Image/edit.html.twig', [
            'image' => $image,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_image_delete", methods="DELETE")
     */
    public function delete(Request $request, Image $image): Response
    {
        if ($this->isCsrfTokenValid('delete'.(int)$image->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($image);
            $em->flush();
        }

        return $this->redirectToRoute('admin_image_index');
    }
}
