<?php

namespace App\Controller\Security;

use App\Entity\Security\Role;
use App\Form\Security\RoleType;
use App\Repository\Security\RoleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/security/role")
 */
class RoleController extends Controller
{
    /**
     * @Route("/", name="security_role_index", methods="GET")
     */
    public function index(RoleRepository $roleRepository): Response
    {
        $roles =  $roleRepository->findAll();

        return $this->render('Security/Role/index.html.twig', ['roles' => $roles]);
    }

    /**
     * @Route("/new", name="security_role_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $role = new Role();
        $form = $this->createForm(RoleType::class, $role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($role);
            $em->flush();

            return $this->redirectToRoute('security_role_index');
        }

        return $this->render('Security/Role/new.html.twig', [
            'role' => $role,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="security_role_show", methods="GET")
     */
    public function show(Role $role): Response
    {
        return $this->render('Security/Role/show.html.twig', ['role' => $role]);
    }

    /**
     * @Route("/{id}/edit", name="security_role_edit", methods="GET|POST")
     */
    public function edit(Request $request, Role $role): Response
    {
        $form = $this->createForm(RoleType::class, $role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('security_role_edit', ['id' => $role->getId()]);
        }

        return $this->render('Security/Role/edit.html.twig', [
            'role' => $role,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="security_role_delete", methods="DELETE")
     */
    public function delete(Request $request, Role $role): Response
    {
        if ($this->isCsrfTokenValid('delete'.$role->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($role);
            $em->flush();
        }

        return $this->redirectToRoute('security_role_index');
    }
}
