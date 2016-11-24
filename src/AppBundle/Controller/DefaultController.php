<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends Controller
{
    /**
     * @Route("/fill", name="fill")
     */
    public function fillAction()
    {

    }

    /**
     * @Route("/article/new", name="new_article")
     * @Method("POST")
     */
    public function newAction(Request $request)
    {

    }

    /**
     * @Route("/", name="homepage")
     * @Method("GET")
     */
    public function listAction()
    {

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