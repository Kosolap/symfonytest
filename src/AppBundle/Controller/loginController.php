<?php
/**
 * Created by PhpStorm.
 * User: ln1
 * Date: 02.09.16
 * Time: 17:35
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\LoginForm;


class loginController extends Controller
{

    /**
     * @Route("/login", name="security_login")
     */
    public function loginAction(){

        $authentcationUtils = $this->get('security.authentication_utils');

        $error = $authentcationUtils->getLastAuthenticationError();

        $lastUsername = $authentcationUtils->getLastUsername();

        $form = $this->createForm(LoginForm::class,['_username' => $lastUsername]);

        return $this->render('security/login.html.twig',
                            array('form' => $form->createView(),
                                'error' => $error));
    }

}