<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request)
    {
        $keyword = $request->query->get('keyword');

        $searchManager = $this->get('app.service.search_manager');

        $data = $searchManager->search($keyword);

        $jsonResponse = new JsonResponse($data);
        $jsonResponse->setEncodingOptions(JSON_PRETTY_PRINT);

        return $jsonResponse;
    }
}
