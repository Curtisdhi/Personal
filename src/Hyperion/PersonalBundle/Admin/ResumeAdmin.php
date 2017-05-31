<?php
namespace Hyperion\PersonalBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ResumeAdmin extends Admin
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
        $resume = $this->getSubject();
        
        // use $fileFieldOptions so we can add other options to the field
        $fileFieldOptions = array('required' => false);
        if ($resume) {
            // get the container so the full path to the image can be set
            $container = $this->getConfigurationPool()->getContainer();
            $fullPath = $container->get('request')->getBasePath() . '/' . $resume->getWebPath();

            if ($fullPath) {
                // add a 'help' option containing the preview's img tag
                $fileFieldOptions['help'] = '<embed src="'. $fullPath .'" width="500" height="500" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html" />';
            }
        } 

        $formMapper
            ->add('published', 'checkbox')
            ->add('resumePath', 'file', array(
                'required' => false,
                'data_class' => null,
                'label' => 'Resume',
                'mapped' => true) + $fileFieldOptions)
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {

    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('published', 'boolean')
            ->add('createdAt', 'datetime')
            ->add('updatedAt', 'datetime');
    }
    
    
    public function prePersist($object) {
        // We get the uploadable manager!
        if (!empty($object->getResumePath())) {
            $uploadableManager = $this->container->get('stof_doctrine_extensions.uploadable.manager');
            $uploadableManager->markEntityToUpload($object, $object->getResumePath());
        }
        
        if ($object->getPublished()) {
            $em = $this->container->get('doctrine')->getEntityManager();
            $resumes = $em->getRepository('HyperionPersonalBundle:Resume')->findAll();
            foreach ($resumes as $r) {
                $r->setPublished(false);
            }
            $object->setPublished(true);
        }
    }
    
    public function preUpdate($object) {
        // We get the uploadable manager!
        if (!empty($object->getResumePath())) {
            $uploadableManager = $this->container->get('stof_doctrine_extensions.uploadable.manager');
            $uploadableManager->markEntityToUpload($object, $object->getResumePath());
        }
        
        
        if ($object->getPublished()) {
            $em = $this->container->get('doctrine')->getEntityManager();
            $resumes = $em->getRepository('HyperionPersonalBundle:Resume')->findAll();
            foreach ($resumes as $r) {
                $r->setPublished(false);
            }
            $object->setPublished(true);
        }
    }
}