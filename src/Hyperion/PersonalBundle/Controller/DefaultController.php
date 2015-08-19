<?php

namespace Hyperion\PersonalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Hyperion\PersonalBundle\Form\Type\ContactFormType;
use Hyperion\PersonalBundle\Form\Model\ContactModel;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $portfolios = $em->getRepository('HyperionPersonalBundle:Portfolio')->findAll();
        
        return $this->render('HyperionPersonalBundle:Default:index.html.twig', array(
            'portfolios' => $portfolios,
        ));
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
    
    public function contactAction(Request $request) {
        $form = $this->createForm(new ContactFormType(), new ContactModel());
        $form->handleRequest($request);
        if ($form->isValid()) {
            $contact = $form->getData();
            
            $recevier =  $this->container->getParameter('mailer_recevier');
            
            try {
                $message = \Swift_Message::newInstance()
                    ->setSubject('Contact by '. $contact->getName())
                    ->setFrom('no-reply@curtisdhi.com')
                    ->setTo($recevier)
                    ->setContentType("text/html")    
                    ->setBody($this->renderView(
                        'HyperionPersonalBundle:Email:contact.html.twig',
                        array('contact' => $contact)
                    ));
                $this->get('session')->getFlashBag()->set('email_success', 'Thank you for sending me an email! :).<br> I shall respond shortly.');
                $this->get('mailer')->send($message);
                
                return $this->redirectToRoute('hyperion_personal_contact');
            }
            catch(\Swift_TransportException $e) {
                $form->addError(new FormError("Failed to send email! If this continues to be a problem, "
                        . "feel free to contact me by other means. Sorry for the inconvenience"));
            }
            
        }
        return $this->render('HyperionPersonalBundle:Default:contact.html.twig', array('form' => $form->createView()));
    }
    
}
