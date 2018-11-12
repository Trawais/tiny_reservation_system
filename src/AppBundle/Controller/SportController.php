<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SportController extends Controller
{
    public function showAllAction()
    {
        return $this->render('AppBundle:Sport:show_all.html.twig', array(
            // ...
        ));
    }

    public function createAction()
    {
        return $this->render('AppBundle:Sport:create.html.twig', array(
            // ...
        ));
    }

}
