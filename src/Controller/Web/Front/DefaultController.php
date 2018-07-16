<?php
/**
 * Created by PhpStorm.
 * User: Dadja
 * Date: 16/07/2018
 * Time: 06:14
 */

namespace App\Controller\Web\Front;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="front_index")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        return $this->render('Web/Front/Default/index.html.twig');
    }
}