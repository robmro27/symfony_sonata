<?php

namespace PolcodeProductBundle\Menu;

use Knp\Menu\FactoryInterface;
use Doctrine\ORM\EntityManager;

class MenuBuilder
{
    private $factory;
    
    private $entityManager;

    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory, EntityManager $entityManager)
    {
        $this->factory = $factory;
        
        $this->entityManager = $entityManager;
    }

    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root');
        
        $menu->addChild('Login', array('route' => 'fos_user_security_login'));
        $menu->addChild('Logout', array('route' => 'fos_user_security_logout'));
        
        $menu->addChild('Home', array('route' => 'homepage'));
        
        // PRODUCTS 
        $menu->addChild('Products', array('route' => 'product_index'));
        
        $products = $this->entityManager->getRepository('PolcodeProductBundle:PolcodeProduct')->findAll();
        
        foreach ( $products as $product ) {
            $menu['Products']->addChild($product->getName(), 
                    array('route' => 'product_show_by_slug',
                          'routeParameters' => array('slug' => $product->getSlug()))
                    );
        }

        return $menu;
    }
}