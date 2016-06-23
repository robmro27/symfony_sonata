<?php

namespace PolcodeProductBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use PolcodeProductBundle\Entity\PolcodeProduct;

class PolcodeProductAdmin extends AbstractAdmin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('translations.name')
            ->add('translations.description')
            ->add('price')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('translation.name')
            ->add('translation.description')
            ->add('locale', null, ['label' => 'Current Locale'])
            ->add('price')
            ->add('_action', null, array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        
        $formMapper
//            ->add('name')
//            ->add('description')
            ->add('price')
            ->add('category', 'sonata_type_model', array(
                'class' => 'PolcodeProductBundle\Entity\PolcodeCategory',
                'property' => 'name',
            ))
            ->add('translations', 'a2lix_translations', array(
            'fields' => array(                      // [optional] Manual configuration of fields to display and options. If not specified, all translatable fields will be display, and options will be auto-detected
                'name' => array(
                    'label' => 'Name',              // [optional] Custom label. Ucfirst, otherwise
                    'field_type' => 'text',           // [optional] Custom type
                    'trim' => true,
                    'required' => true
                ),
                'slug' => array(
                    'label' => 'Slug (Leave empty for auto update)',              // [optional] Custom label. Ucfirst, otherwise
                    'field_type' => 'text',           // [optional] Custom type
                    'trim' => true,
                    'required' => false,
                ), 
                'description' => array(
                    'label' => 'Description',              // [optional] Custom label. Ucfirst, otherwise
                    'field_type' => 'textarea',           // [optional] Custom type
                    'required' => true,
                ))));
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name')
            ->add('description')
            ->add('locale')
            ->add('price');
        ;
    }
    
    public function toString($object)
    {
        return $object instanceof PolcodeProduct
            ? $object->getName()
            : 'Product'; 
    }
}
