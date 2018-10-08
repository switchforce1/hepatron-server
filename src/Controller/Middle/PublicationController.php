<?php

namespace App\Controller\Middle;

use App\Builder\Middle\PublicationBuilder;
use App\Entity\Admin\Member;
use App\Entity\Middle\Publication;
use App\Form\Middle\PublicationType;
use App\Handler\Admin\MemberHandler;
use App\Handler\Middle\PublicationHandler;
use App\Repository\Middle\PublicationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/middle/publication")
 */
class PublicationController extends Controller
{
    /**
     * @Route("/", name="middle_publication_index", methods="GET")
     */
    public function index(PublicationRepository $publicationRepository): Response
    {
        return $this->render('Middle/Publication/index.html.twig', ['publications' => $publicationRepository->findAll()]);
    }

    /**
     * @Route("/new", name="middle_publication_new", methods="GET|POST")
     *
     * @param Request $request
     * @param MemberHandler $memberHandler
     * @param PublicationHandler $publicationHandler
     * @return Response
     * @throws \Exception
     */
    public function new(Request $request,
                        MemberHandler $memberHandler,
                        PublicationHandler $publicationHandler): Response
    {
        $user = $this->getUser();
        /** @var Member $member */
        $member = $memberHandler->getMemberOfUser($user);

        $publication = $publicationHandler->createPublicationFor($member);


        $form = $this->createForm(PublicationType::class, $publication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($publication);
            $em->flush();

            return $this->redirectToRoute('middle_publication_index');
        }

        return $this->render('Middle/Publication/new.html.twig', [
            'publication' => $publication,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="middle_publication_show", methods="GET")
     */
    public function show(Publication $publication): Response
    {
        return $this->render('Middle/Publication/show.html.twig', ['publication' => $publication]);
    }

    /**
     * @Route("/{id}/edit", name="middle_publication_edit", methods="GET|POST")
     */
    public function edit(Request $request, Publication $publication): Response
    {
        $form = $this->createForm(PublicationType::class, $publication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('middle_publication_edit', ['id' => $publication->getId()]);
        }

        return $this->render('Middle/Publication/edit.html.twig', [
            'publication' => $publication,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="middle_publication_delete", methods="DELETE")
     */
    public function delete(Request $request, Publication $publication): Response
    {
        if ($this->isCsrfTokenValid('delete'.$publication->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($publication);
            $em->flush();
        }

        return $this->redirectToRoute('middle_publication_index');
    }
}
