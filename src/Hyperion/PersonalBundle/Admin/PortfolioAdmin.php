<?php
namespace Hyperion\PersonalBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PortfolioAdmin extends Admin
{
    
    private $container = null;

    public function __construct($code, $class, $baseControllerName, $container = null) {
        parent::__construct($code, $class, $baseControllerName);
        $this->container = $container;
    }
    
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $fullPath = null;
        $image = $this->getSubject();
        
        // use $fileFieldOptions so we can add other options to the field
        $fileFieldOptions = array('required' => false);
        if ($image) {
            // get the container so the full path to the image can be set
            $container = $this->getConfigurationPool()->getContainer();
            $fullPath = $container->get('request')->getBasePath() . '/' . $image->getWebPath();

            if ($fullPath) {
                // add a 'help' option containing the preview's img tag
                $fileFieldOptions['help'] = '<img src="' . $fullPath . '" class="admin-preview" />';
            }
        } 

        $formMapper
            ->add('post', 'sonata_type_admin')
            ->add('imgPath', 'file', array(
                'required' => false,
                'data_class' => null,
                'label' => 'Banner Image',
                'mapped' => true) + $fileFieldOptions)
            
            ->add('projectYear', 'integer')
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
    
    
    public function prePersist($object) {
        // We get the uploadable manager!
        if (!empty($object->getImgPath())) {
            $uploadableManager = $this->container->get('stof_doctrine_extensions.uploadable.manager');
            $uploadableManager->markEntityToUpload($object, $object->getImgPath());
        }
    }
    
    public function preUpdate($object) {
        // We get the uploadable manager!
        if (!empty($object->getImgPath())) {
            $uploadableManager = $this->container->get('stof_doctrine_extensions.uploadable.manager');
            $uploadableManager->markEntityToUpload($object, $object->getImgPath());
        }
    }
}