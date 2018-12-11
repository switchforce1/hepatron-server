<?php

namespace App\Controller\Security;

use App\Entity\Security\User;
use App\Form\Security\RegisterType;
use App\Form\Security\UserType;
use App\Repository\Security\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GeneralController
 * @package App\Controller\Security
 */
class GeneralController extends Controller
{
    /**
     * @Route("/", name="security_general_index", methods="GET")
     */
//    public function index(UserRepository $userRepository): Response
//    {
//        return $this->render('Security/General/index.html.twig', ['users' => $userRepository->findAll()]);
//    }

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
     * @Route("/edit-profile", name="security_general_edit_profile", methods="GET|POST")
     */
    public function edit(Request $request, UserRepository $userRepository): Response
    {
        if(!$this->isGranted("ROLE_USER")){
            throw new \Exception("You must be logged until edit your profile");
        }
        $user = $this->getUser();

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
}
