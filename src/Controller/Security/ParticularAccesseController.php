<?php

namespace App\Controller\Security;

use App\Entity\Security\ParticularAccesse;
use App\Form\Security\ParticularAccesseType;
use App\Repository\Security\ParticularAccesseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/security/particular/accesse")
 */
class ParticularAccesseController extends Controller
{
    /**
     * @Route("/", name="security_particular_accesse_index", methods="GET")
     */
    public function index(ParticularAccesseRepository $particularAccesseRepository): Response
    {
        return $this->render('Security/ParticularAccesse/index.html.twig', ['particular_accesses' => $particularAccesseRepository->findAll()]);
    }

    /**
     * @Route("/new", name="security_particular_accesse_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $particularAccesse = new ParticularAccesse();
        $form = $this->createForm(ParticularAccesseType::class, $particularAccesse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($particularAccesse);
            $em->flush();

            return $this->redirectToRoute('security_particular_accesse_index');
        }

        return $this->render('Security/ParticularAccesse/new.html.twig', [
            'particular_accesse' => $particularAccesse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="security_particular_accesse_show", methods="GET")
     */
    public function show(ParticularAccesse $particularAccesse): Response
    {
        return $this->render('Security/ParticularAccesse/show.html.twig', ['particular_accesse' => $particularAccesse]);
    }

    /**
     * @Route("/{id}/edit", name="security_particular_accesse_edit", methods="GET|POST")
     */
    public function edit(Request $request, ParticularAccesse $particularAccesse): Response
    {
        $form = $this->createForm(ParticularAccesseType::class, $particularAccesse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('security_particular_accesse_edit', ['id' => $particularAccesse->getId()]);
        }

        return $this->render('Security/ParticularAccesse/edit.html.twig', [
            'particular_accesse' => $particularAccesse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="security_particular_accesse_delete", methods="DELETE")
     */
    public function delete(Request $request, ParticularAccesse $particularAccesse): Response
    {
        if ($this->isCsrfTokenValid('delete'.(int)$particularAccesse->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($particularAccesse);
            $em->flush();
        }

        return $this->redirectToRoute('security_particular_accesse_index');
    }
}
