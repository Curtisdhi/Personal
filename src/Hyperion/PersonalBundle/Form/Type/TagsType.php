<?php
namespace Hyperion\PersonalBundle\Form\Type;

 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Hyperion\PersonalBundle\Form\DataTransformer\TagsTransformer;
 
class TagsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new TagsTransformer();
        $builder->addModelTransformer($transformer);
        
    }
 
    public function getParent()
    {
        return 'text';
    }
 
    public function getName()
    {
        return 'tags';
    }
    
}