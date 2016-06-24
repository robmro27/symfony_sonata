<?php

namespace PolcodeProductBundle\Menu;

use Knp\Menu\FactoryInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class MenuBuilder
{
    private $factory;
    
    private $entityManager;

    private $authorizationChecker;
    
    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory, EntityManager $entityManager, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->factory = $factory;
        
        $this->entityManager = $entityManager;
        
        $this->authorizationChecker = $authorizationChecker;
    }

    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root');
    	$menu->setChildrenAttribute('class', 'nav navbar-nav');
        
        
        if ($this->authorizationChecker->isGranted('IS_AUTHENTICATED_FULLY')) {
            $menu->addChild('Profile', array('route' => 'fos_user_profile_edit'));
        } else {
            $menu->addChild('Login', array('route' => 'fos_user_security_login'));
        }
        
        
        
        
        $menu->addChild('Logout', array('route' => 'fos_user_security_logout'));
        
        $menu->addChild('Home', array('route' => 'homepage'));
        
        // PRODUCTS 
        $menu->addChild('Products', array('route' => 'product_index'))
             ->setAttribute('dropdown', true);
        $menu['Products']->addChild('All products', array('route' => 'product_index'));
        
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