<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Video;
use App\Form\Admin\VideoType;
use App\Repository\Admin\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/video")
 */
class VideoController extends Controller
{
    /**
     * @Route("/", name="admin_video_index", methods="GET")
     */
    public function index(VideoRepository $videoRepository): Response
    {
        return $this->render('Admin/Video/index.html.twig', ['videos' => $videoRepository->findAll()]);
    }

    /**
     * @Route("/new", name="admin_video_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $video = new Video();
        $form = $this->createForm(VideoType::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($video);
            $em->flush();

            return $this->redirectToRoute('admin_video_index');
        }

        return $this->render('Admin/Video/new.html.twig', [
            'video' => $video,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_video_show", methods="GET")
     */
    public function show(Video $video): Response
    {
        return $this->render('Admin/Video/show.html.twig', ['video' => $video]);
    }

    /**
     * @Route("/{id}/edit", name="admin_video_edit", methods="GET|POST")
     */
    public function edit(Request $request, Video $video): Response
    {
        $form = $this->createForm(VideoType::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_video_edit', ['id' => $video->getId()]);
        }

        return $this->render('Admin/Video/edit.html.twig', [
            'video' => $video,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_video_delete", methods="DELETE")
     */
    public function delete(Request $request, Video $video): Response
    {
        if ($this->isCsrfTokenValid('delete'.$video->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($video);
            $em->flush();
        }

        return $this->redirectToRoute('admin_video_index');
    }
}
