<?php
namespace Hyperion\PersonalBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PortfolioAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('post', 'sonata_type_admin')
            ->add('projectDate', 'date')
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('post.title')
            ->add('post.author')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('post.title', 'text', array('editable' => true))
            ->add('post.slug', 'text', array('editable' => true))
            ->add('post.author', 'text')
            ->add('projectYear', 'text', array('editable' => true))
        ;
    }
}