<?php

namespace David\MathBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlayerController extends Controller
{
    public function CreateAction()
    {
        return $this->render('DavidMathBundle:Player:Create.html.twig', array(
                // ...
            ));    }

    public function DeleteAction()
    {
        return $this->render('DavidMathBundle:Player:Delete.html.twig', array(
                // ...
            ));    }

    public function SetupAction()
    {
        return $this->render('DavidMathBundle:Player:Setup.html.twig', array(
                // ...
            ));    }

}
