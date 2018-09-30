<?php

namespace App\Controller\Middle;

use App\Entity\Middle\Item;
use App\Form\Middle\ItemType;
use App\Repository\Middle\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/middle/item")
 */
class ItemController extends Controller
{
    /**
     * @Route("/", name="middle_item_index", methods="GET")
     */
    public function index(ItemRepository $itemRepository): Response
    {
        return $this->render('Middle/Item/index.html.twig', ['items' => $itemRepository->findAll()]);
    }

    /**
     * @Route("/new", name="middle_item_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $item = new Item();
        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();

            return $this->redirectToRoute('middle_item_index');
        }

        return $this->render('Middle/Item/new.html.twig', [
            'item' => $item,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="middle_item_show", methods="GET")
     */
    public function show(Item $item): Response
    {
        return $this->render('Middle/Item/show.html.twig', ['item' => $item]);
    }

    /**
     * @Route("/{id}/edit", name="middle_item_edit", methods="GET|POST")
     */
    public function edit(Request $request, Item $item): Response
    {
        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('middle_item_edit', ['id' => $item->getId()]);
        }

        return $this->render('Middle/Item/edit.html.twig', [
            'item' => $item,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="middle_item_delete", methods="DELETE")
     */
    public function delete(Request $request, Item $item): Response
    {
        if ($this->isCsrfTokenValid('delete'.$item->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($item);
            $em->flush();
        }

        return $this->redirectToRoute('middle_item_index');
    }
}
