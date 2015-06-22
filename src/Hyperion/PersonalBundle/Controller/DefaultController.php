<?php

namespace Hyperion\PersonalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HyperionPersonalBundle:Default:index.html.twig');
    }
}
