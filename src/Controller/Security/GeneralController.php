<?php

namespace App\Controller\Security;

use App\Entity\Security\User;
use App\Form\Security\RegisterType;
use App\Form\Security\UserType;
use App\Repository\Security\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/security")
 */
class GeneralController extends Controller
{
    /**
     * @Route("/", name="security_general_index", methods="GET")
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('Security/General/index.html.twig', ['users' => $userRepository->findAll()]);
    }

    /**
     * @Route("/register", name="security_general_new", methods="GET|POST")
     *
     * @param Request $request
     * @return Response
     */
    public function register(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('security_user_index');
        }

        return $this->render('Security/General/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="security_general_show", methods="GET")
     */
    public function profil(User $user): Response
    {
        return $this->render('Security/General/show.html.twig', ['user' => $user]);
    }

    /**
     * @Route("/{id}/edit", name="security_general_edit", methods="GET|POST")
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('security_user_edit', ['id' => $user->getId()]);
        }

        return $this->render('Security/General/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="security_general_delete", methods="DELETE")
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('security_user_index');
    }
}
