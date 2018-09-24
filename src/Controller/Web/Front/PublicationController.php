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

/**
 * @Route("/publication")
 */
class PublicationController extends Controller
{
    /**
     * @Route("/", name="front_publication_all")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function all(Request $request)
    {
        return $this->render('Web/Front/Publication/all.html.twig');
    }

    /**
     * @Route("/styles", name="front_publication_styles")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function styles(Request $request)
    {
        return $this->render('Web/Front/Publication/styles.html.twig');
    }

    /**
     * @Route("/creations", name="front_publication_creations")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function creations(Request $request)
    {
        return $this->render('Web/Front/Publication/creations.html.twig');
    }

    /**
     * @Route("/products", name="front_publication_products")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function products(Request $request)
    {
        return $this->render('Web/Front/Publication/products.html.twig');
    }

    /**
     * @Route("/events", name="front_publication_events")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function events(Request $request)
    {
        return $this->render('Web/Front/Publication/events.html.twig');
    }
}