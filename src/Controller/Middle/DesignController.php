<?php

namespace App\Controller\Middle;

use App\DTO\Middle\DesignDTO;
use App\Entity\Middle\Design;
use App\Entity\Security\User;
use App\Factory\DTO\Middle\DesignDTOFactory;
use App\Form\Middle\DesignType;
use App\Handler\Middle\DesignHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/middle/design")
 */
class DesignController extends Controller
{
    /**
     * @Route("/", name="middle_design_index", methods="GET")
     */
    public function index(): Response
    {
        $designs = $this->getDoctrine()
            ->getRepository(Design::class)
            ->findAll();

        return $this->render('Middle/Design/index.html.twig', ['designs' => $designs]);
    }

    /**
     * @Route("/new", name="middle_design_new", methods="GET|POST")
     */
    public function new(Request $request, DesignDTOFactory $designFactory, DesignHandler $designHandler): Response
    {
        $design = $designFactory->create();
        $form = $this->createForm(DesignType::class, $design, array(
            "action" => $this->generateUrl('middle_design_new')
        ));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $currentUser */
            $currentUser = $this->getUser();
            $medias = $request->files->get('design')['medias'];
            $errors = $designHandler->save($design, $medias, $currentUser);

            return $this->redirectToRoute('middle_design_index');
        }elseif ($form->isSubmitted() && !$form->isValid()){
            dump($form->getErrors());
        }

        return $this->render('Middle/Design/new.html.twig', [
            'design' => $design,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="middle_design_show", methods="GET")
     */
    public function show(Design $design): Response
    {
        return $this->render('Middle/Design/show.html.twig', ['design' => $design]);
    }

    /**
     * @Route("/{id}/edit", name="middle_design_edit", methods="GET|POST")
     */
    public function edit(Request $request, Design $design): Response
    {
        $form = $this->createForm(DesignType::class, $design);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('middle_design_edit', ['id' => $design->getId()]);
        }

        return $this->render('Middle/Design/edit.html.twig', [
            'design' => $design,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="middle_design_delete", methods="DELETE")
     */
    public function delete(Request $request, Design $design): Response
    {
        if ($this->isCsrfTokenValid('delete'.(int)$design->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($design);
            $em->flush();
        }

        return $this->redirectToRoute('middle_design_index');
    }
}
