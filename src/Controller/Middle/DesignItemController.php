<?php

namespace App\Controller\Middle;

use App\Entity\Middle\DesignItem;
use App\Form\Middle\DesignItemType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/middle/design/item")
 */
class DesignItemController extends Controller
{
    /**
     * @Route("/", name="middle_design_item_index", methods="GET")
     */
    public function index(): Response
    {
        $designItems = $this->getDoctrine()
            ->getRepository(DesignItem::class)
            ->findAll();

        return $this->render('Middle/DesignItem/index.html.twig', ['design_items' => $designItems]);
    }

    /**
     * @Route("/new", name="middle_design_item_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $designItem = new DesignItem();
        $form = $this->createForm(DesignItemType::class, $designItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($designItem);
            $em->flush();

            return $this->redirectToRoute('middle_design_item_index');
        }

        return $this->render('Middle/DesignItem/new.html.twig', [
            'design_item' => $designItem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="middle_design_item_show", methods="GET")
     */
    public function show(DesignItem $designItem): Response
    {
        return $this->render('Middle/DesignItem/show.html.twig', ['design_item' => $designItem]);
    }

    /**
     * @Route("/{id}/edit", name="middle_design_item_edit", methods="GET|POST")
     */
    public function edit(Request $request, DesignItem $designItem): Response
    {
        $form = $this->createForm(DesignItemType::class, $designItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('middle_design_item_edit', ['id' => $designItem->getId()]);
        }

        return $this->render('Middle/DesignItem/edit.html.twig', [
            'design_item' => $designItem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="middle_design_item_delete", methods="DELETE")
     */
    public function delete(Request $request, DesignItem $designItem): Response
    {
        if ($this->isCsrfTokenValid('delete'.$designItem->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($designItem);
            $em->flush();
        }

        return $this->redirectToRoute('middle_design_item_index');
    }
}
