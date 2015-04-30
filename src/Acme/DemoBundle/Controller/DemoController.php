<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Acme\DemoBundle\Form\ContactType;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DemoController extends Controller
{

	// BY WALEED: BELOW COMMITED LINES ARE IMPORTANT THIS IS CALLED ANNOTATION @Route WILL DEFINE WHAT WILL BE THE URL
	// OF BELOW ACTION. THE METHOD indexAction IS CALLED ACTION IN SYMFONY
	// EVERY PUBLIC METHOD IN CONTROLLER CLASS IS CORRESPOND TO A URL.

	// SO WHEN YOU CONFIGURE SYMFONY ON YOUR LOCAL HOST AND TYPE HTTP://LOCALHOST  BELOW INDEX ACTION WILL RUN BECAUSE IT HAS
	// "/" ROUTE IF YOU PUT @Route("/noel-is-tesing", name="_demo") THEN YOU WILL TYPE HTTP://LOCALHOST/neol-is-testing to run
	//beLow index method. ROUTE NAME MUST BE UNIQUE

	// @template() ANNOTATION WILL DEFINE WHAT VIEW WILL BE USED FOR THIS ACTION. EMPTY MEAN IT WILL SEARCH SAME NAME "INDEX" IN
	// src/Acme/Demobundle/Resources/views/Demo/index.html.twig

	// if you put @Template('contact') THEN SYMFONY WILL "CONTACT" VIEW INTO INDEX ACTION

    /**
     * @Route("/", name="_demo")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/hello/{name}", name="_demo_hello")
     * @Template()
     */
    public function helloAction($name)
    {
        return array('name' => $name);
    }

    /**
     * @Route("/contact", name="_demo_contact")
     * @Template()
     */
    public function contactAction(Request $request)
    {
        $form = $this->createForm(new ContactType());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $mailer = $this->get('mailer');

            // .. setup a message and send it
            // http://symfony.com/doc/current/cookbook/email.html

            $request->getSession()->getFlashBag()->set('notice', 'Message sent!');

            return new RedirectResponse($this->generateUrl('_demo'));
        }

        return array('form' => $form->createView());
    }
}
