<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/app/example", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * create new Product
     * @return Response
     */
    public function createAction()
    {
        $product = new Product();
        $product->setName('LG P970 - ' . sprintf('%9d', rand(1, 999999999)));
        $product->setDescription([
            'type' => 'mobile'
        ]);
        $product->setPrice(1800000);

        $em = $this->getDoctrine()->getManager();

        $em->persist($product);
        $em->flush();

        return new Response('Created product id #' . $product->getId());
    }

    /**
     * Show one Product
     * @param $id
     * @return Response
     */
    public function showAction($id)
    {
        $repo = $this->getDoctrine()->getRepository('AppBundle:Product');

        /** @var Product $product */
        $product = $repo->find($id);

        if (!$product) {
            throw $this->createNotFoundException('No product found for id #' . $id);
        }

        return new Response('Found Product id #' . $product->getId() . ': ' . $product->getName());
    }

    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $repo = $this->getDoctrine()->getRepository('AppBundle:Product');

        /** @var Product $product */
        $product = $repo->find($id);

        if (!$product) {
            throw $this->createNotFoundException('No product found for id #' . $id);
        }

        $product->setName('LG P970 - ' . 'new - ' . sprintf('%9d', rand(1, 999999999)));
        //$em->persist($product);
        $em->flush();

        return new Response('Updated product id #' . $product->getId());
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $repo = $this->getDoctrine()->getRepository('AppBundle:Product');

        /** @var Product $product */
        $product = $repo->find($id);

        if (!$product) {
            throw $this->createNotFoundException('No product found for id #' . $id);
        }

        $em->remove($product);
        $em->flush();

        return new Response('Removed product id #' . $product->getId());
    }
}
