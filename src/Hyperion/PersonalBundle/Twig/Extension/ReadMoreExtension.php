<?php

namespace Hyperion\PersonalBundle\Twig\Extension;

class ReadMoreExtension extends \Twig_Extension
{
    private $readmoreTag;
    
    public function __construct($readmoreTag='[readmoref]') {
        $this->readmoreTag = $readmoreTag;
    }
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('readmore', array($this, 'readMoreFilter')),
        );
    }

    public function readMoreFilter($html, $truncate=true, $url='')
    {
        if ($truncate) {
            //truncate before "readmore"
            $index = stripos($html, $this->readmoreTag);
            if ($index) {
                $html = substr($html, 0, $index);
                $html .= '<a href="'. $url .'">Read more...</a>';
            }
        }
        else {
            //just remove the readmore tag
            $html = str_ireplace($this->readmoreTag, '', $html);
        }
        
        return $html;
    }

    public function getName()
    {
        return 'readmore_extension';
    }
}