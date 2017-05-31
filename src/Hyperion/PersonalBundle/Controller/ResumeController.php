<?php

namespace Hyperion\PersonalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ResumeController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $resume = $em->getRepository('HyperionPersonalBundle:Resume')->findOneBy(array('published' => true));

        if (!$resume) {
            throw $this->createNotFoundException('No resume is on file.');
        }

        return $this->render('HyperionPersonalBundle:Resume:index.html.twig', array(
            'resume' => $resume,
        ));
    }

}
