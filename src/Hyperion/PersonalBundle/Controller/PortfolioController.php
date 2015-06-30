<?php

namespace Hyperion\PersonalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PortfolioController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $portfolios = $em->getRepository('HyperionPersonalBundle:Portfolio')->findAll();
        
        return $this->render('HyperionPersonalBundle:Portfolio:index.html.twig', array(
            'portfolios' => $portfolios,
        ));
    }
    
    public function postAction($slug) {
        $em = $this->getDoctrine()->getManager();
        
        $repo = $em->getRepository('HyperionPersonalBundle:Portfolio');
        $portfolio = $repo->createQueryBuilder('port')
            ->innerJoin('port.post', 'post')
            ->where('post.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getSingleResult();
        
        return $this->render('HyperionPersonalBundle:Portfolio:post.html.twig', array(
            'portfolio' => $portfolio,
        ));
    }

}
