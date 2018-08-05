<?php

namespace App\Controller\Security;

use App\Entity\Security\Profil;
use App\Form\Security\ProfilType;
use App\Repository\Security\ProfilRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/security/profil")
 */
class ProfilController extends Controller
{
    /**
     * @Route("/", name="security_profil_index", methods="GET")
     */
    public function index(ProfilRepository $profilRepository): Response
    {
        return $this->render('Security/Profil/index.html.twig', ['profils' => $profilRepository->findAll()]);
    }

    /**
     * @Route("/new", name="security_profil_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $profil = new Profil();
        $form = $this->createForm(ProfilType::class, $profil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($profil);
            $em->flush();

            return $this->redirectToRoute('security_profil_index');
        }

        return $this->render('Security/Profil/new.html.twig', [
            'profil' => $profil,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="security_profil_show", methods="GET")
     */
    public function show(Profil $profil): Response
    {
        return $this->render('Security/Profil/show.html.twig', ['profil' => $profil]);
    }

    /**
     * @Route("/{id}/edit", name="security_profil_edit", methods="GET|POST")
     */
    public function edit(Request $request, Profil $profil): Response
    {
        $form = $this->createForm(ProfilType::class, $profil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('security_profil_edit', ['id' => $profil->getId()]);
        }

        return $this->render('Security/Profil/edit.html.twig', [
            'profil' => $profil,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="security_profil_delete", methods="DELETE")
     */
    public function delete(Request $request, Profil $profil): Response
    {
        if ($this->isCsrfTokenValid('delete'.$profil->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($profil);
            $em->flush();
        }

        return $this->redirectToRoute('security_profil_index');
    }
}
