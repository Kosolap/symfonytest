<?php
/**
 * Created by PhpStorm.
 * User: kosolap
 * Date: 01.09.16
 * Time: 22:40
 */

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class mainController extends Controller
{

    /**
     * @Route("/save")
     */
    public function saveAction(){

        $request = Request::createFromGlobals();


        $user = new User();
        $user->setName($request->query->get('name'));


        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();


        return new Response('Succes');
    }

    /**
     * @Route("/loadAll")
     */
    public function loadAllAction(){

        $em = $this->getDoctrine()->getEntityManager();
        $users = $em->getRepository('AppBundle\Entity\User')->findAll();


        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);

        $result = array();

        foreach ($users as $user){
            array_push($result,$serializer->serialize($user, 'json'));
        }

        return new JsonResponse(array('users' => $result));
    }

    /**
     * @Route("/")
     */
    public function mainAction(){

        return $this->render('/pages/main.html.twig');
    }


}