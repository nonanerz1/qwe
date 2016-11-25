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
     * @Route("/new", name="new")
     * @Method("POST")
     */
    public function newAction(Request $request)
    {

        $entity = new \stdClass();
        $entity->title = 'Some title'.rand();
        $entity->content = 'Some content'.rand();

        $fs = new Filesystem();

        $fs->dumpFile(__DIR__.'/../../../web/db/'.rand(0,10).'.json', json_encode($entity));

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
        return new JsonResponse($files, 200);

    }

    /**
     * @Route("/edit/{fileName}")
     * @Method({"PUT", "PATCH"})
     */
    public function editAction($fileName)
    {
        $handle = opendir(__DIR__.'/../../../web/db');

        $files = [];

        while (false !== ($file = readdir($handle))) {

            if ($file !== '.' && $file !== '..'){
                $files[] = $file;
            }
        }

        if (in_array($fileName.'.json', $files)){

            $article = json_decode(file_get_contents(__DIR__.'/../../../web/db/'.$fileName.'.json'));

            $article->title = 'Another title';

            $article->content = 'Another content';

            $fs = new Filesystem();

            $fs->dumpFile(__DIR__.'/../../../web/db/'.$fileName.'.json', json_encode($article));

            return new JsonResponse($article);
        }

        return new Response('File '.$fileName.' not found!', 404);
    }

    /**
     * @Route("/remove/{fileName}")
     * @Method("DELETE")
     */
    public function removeAction($fileName)
    {
        $handle = opendir(__DIR__.'/../../../web/db');

        $files = [];

        while (false !== ($file = readdir($handle))) {

            if ($file !== '.' && $file !== '..'){
                $files[] = $file;

            }

        }
        if (in_array($fileName.'.json', $files)){

            unlink(__DIR__.'/../../../web/db/'.$fileName.'.json');

        }

        return new Response(null, 204);

    }

}