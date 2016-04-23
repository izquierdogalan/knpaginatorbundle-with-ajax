<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="products", options={"expose"=true})
     */
    public function productsAction(Request $request)
    {
        $paginator = $this->get('knp_paginator');

        $products = $paginator->paginate(
            $this->get('app.manager.product')->getAllProductsPaginated(),
            $request->query->get('page', 1)
        );

        if ($request->isXmlHttpRequest()) {
            $products = $this->renderView(':default/includes:products_table.html.twig', array(
                'products' => $products
            ));

            return new JsonResponse($products);
        }

        return $this->render(':default:products.html.twig', array(
            'products' => $products
        ));
    }
}
