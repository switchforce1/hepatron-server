<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Image;
use App\Form\Admin\ImageType;
use App\Repository\Admin\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/")
 */
class MemberController extends Controller
{
    /**
     * @Route("/myinfos", name="admin_default_member_infos", methods="GET")
     */
    public function infos(): Response
    {
        $user = $this->getUser();

        if(!$user){
            throw new HttpException(400, "You must be connected accessthis page");
        }

        return $this->render('Admin/Member/infos.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/myimages", name="admin_default_member_infos", methods="GET")
     */
    public function images(): Response
    {
        $user = $this->getUser();
        if(!$user){
            throw new HttpException(400, "You must be connected access this page");
        }

        return $this->render('Admin/Member/images.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/myimages", name="admin_default_member_infos", methods="GET")
     */
    public function publications(): Response
    {
        $user = $this->getUser();

        if(!$user){
            throw new HttpException(400, "You must be connected access this page");
        }

        return $this->render('Admin/Member/images.html.twig', [
            'user' => $user
        ]);
    }

}
