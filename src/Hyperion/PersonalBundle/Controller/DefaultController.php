<?php

namespace Hyperion\PersonalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HyperionPersonalBundle:Default:index.html.twig');
    }
    
    public function blogAction() {
        $em = $this->getDoctrine()->getManager();
        
        $posts = $em->getRepository('HyperionPersonalBundle:Post')->findAll();
        
        return $this->render('HyperionPersonalBundle:Blog:index.html.twig', array(
            'posts' => $posts,
        ));
    }
    
    public function postAction($slug) {
        $em = $this->getDoctrine()->getManager();
        
        $post = $em->getRepository('HyperionPersonalBundle:Post')->findOneBySlug($slug);
        
        return $this->render('HyperionPersonalBundle:Blog:post.html.twig', array(
            'post' => $post,
        ));
    }
    
}
