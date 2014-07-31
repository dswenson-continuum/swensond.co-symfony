<?php

namespace David\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use David\WebBundle\Form\Type\ContactType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DavidWebBundle:Default:index.html.twig');
    }
    public function aboutAction()
    {
        return $this->render('DavidWebBundle:Default:about.html.twig');
    }
    public function contactAction(Request $request)
    {
        $form = $this->createForm(new ContactType());
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $message = \Swift_Message::newInstance()
                    ->setSubject($form->get('subject')->getData())
                    ->setFrom($form->get('email')->getData())
                    ->setTo('david@swensond.co')
                    ->setBody(
                        $this->renderView(
                            'DavidWebBundle:Mail:contact.html.twig',
                            array(
                                'ip' => $request->getClientIp(),
                                'name' => $form->get('name')->getData(),
                                'message' => $form->get('message')->getData()
                            )
                        )
                    );
                $this->get('mailer')->send($message);
                $request->getSession()->getFlashBag()->add('success', 'Your email has been sent! Thanks!');
                return $this->redirect($this->generateUrl('david_web_contact'));
            }
        }
        return $this->render('DavidWebBundle:Default:contact.html.twig', array('form' => $form->createView()));
    }
}
