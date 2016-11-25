<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/fill", name="fill")
     */
    public function fillAction()
    {

    }

    /**
     * @Route("/new", name="new")
     * @Method("POST")
     */
    public function newAction(Request $request)
    {

        $entity = new \stdClass();
        $entity->title = 'Какой-то заголовок'.rand();
        $entity->content = 'Какой-то контент'.rand();

        $fs = new Filesystem();

        $fs->dumpFile(__DIR__.'/../../../web/db/newFile'.rand(0,10).'.json', json_encode($entity));

        $response = new JsonResponse($entity, 201);

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/", name="homepage")
     * @Method("GET")
     */
    public function listAction()
    {
        $handle = opendir(__DIR__.'/../../../web/db');

        $files = [];

        while (false !== ($file = readdir($handle))) {

            if ($file !== '.' && $file !== '..'){
                $files[] = json_decode(file_get_contents(__DIR__.'/../../../web/db/'.$file));
            }

        }
        $response = new JsonResponse($files, 200);

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/article/edit/{id}")
     * @Method("PUT")
     */
    public function editAction(Article $article)
    {

    }

    /**
     * @Route("/article/remove/{id}")
     * @Method("DELETE")
     */
    public function removeAction()
    {

    }

}