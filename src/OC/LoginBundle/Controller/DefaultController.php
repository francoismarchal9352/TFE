<?php

namespace OC\LoginBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('OCLoginBundle:Default:index.html.twig');
    }
}
