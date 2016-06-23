<?php

namespace PolcodeProductBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;

/**
 * Description of ProductCRUDController
 *
 * @author rmroz
 */
class ProductCRUDController extends Controller
{
    
    /**
     * Override delete action to ceheck if user has SUPERADMIN_ROLE
     */
    public function deleteAction($id)
    {
        
        $this->denyAccessUnlessGranted('ROLE_SUPERADMIN', null, 'Unable to access this page!');
        
        return parent::deleteAction($id);
    }
    
}
