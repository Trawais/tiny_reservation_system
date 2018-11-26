<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SecurityController extends Controller
{
    public function loginAction()
    {
        // redirect user to reservation overview, if he is already authenticated
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('show_all_reservation_slot');
        }

        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUserName();

        $form = $this->createFormBuilder(['username' => $lastUsername])
            ->add('username', TextType::class, ['label' => 'Uzivatel'])
            ->add('password', PasswordType::class, ['label' => 'Heslo'])
            ->add('login', SubmitType::class, ['label' => 'Prihlasit'])
            ->getForm();

        return $this->render('AppBundle:security:login.html.twig', [
            'form' => $form->createView(),
            'error' => $error
        ]);
    }
}