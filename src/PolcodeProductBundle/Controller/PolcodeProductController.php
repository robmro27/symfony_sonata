<?php

namespace PolcodeProductBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use PolcodeProductBundle\Entity\PolcodeProduct;

/**
 * PolcodeProduct controller.
 *
 * @Route("/product")
 */
class PolcodeProductController extends Controller
{
    /**
     * Lists all PolcodeProduct entities.
     *
     * @Route("/", name="product_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $polcodeProducts = $em->getRepository('PolcodeProductBundle:PolcodeProduct')->findAll();

        return $this->render('polcodeproduct/index.html.twig', array(
            'polcodeProducts' => $polcodeProducts,
        ));
    }

    /**
     * Finds and displays a PolcodeProduct entity by its slug.
     *
     * @Route("/{slug}", name="product_show_by_slug")
     * @Method("GET")
     */
    public function showBySlugAction( $slug ) 
    {
        $em = $this->getDoctrine()->getManager();
        
        $polcodeProduct = $em->getRepository('PolcodeProductBundle:PolcodeProduct')->findOneBySlug($slug);
        
        return $this->render('polcodeproduct/show.html.twig', array(
            'polcodeProduct' => $polcodeProduct,
        ));
        
    }
    
    
    /**
     * Finds and displays a PolcodeProduct entity.
     *
     * @Route("/show/{id}", name="product_show")
     * @Method("GET")
     */
    public function showAction(PolcodeProduct $polcodeProduct)
    {

        return $this->render('polcodeproduct/show.html.twig', array(
            'polcodeProduct' => $polcodeProduct,
        ));
    }
    
    
    
}
