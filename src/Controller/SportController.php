<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SportController extends AbstractController
{
    public function showAllAction()
    {
        return $this->render("Sport/show_all.html.twig", array(
            // ...
        ));
    }

    public function createAction()
    {
        return $this->render("Sport/create.html.twig", array(
            // ...
        ));
    }

}
