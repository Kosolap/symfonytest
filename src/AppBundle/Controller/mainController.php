<?php
/**
 * Created by PhpStorm.
 * User: kosolap
 * Date: 01.09.16
 * Time: 22:40
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class mainController extends Controller
{
    /**
     * @Route("/{name}")
     */
    public function showAction($name){
        return $this->render('hello.html.twig',['name'=>$name]);
    }

}