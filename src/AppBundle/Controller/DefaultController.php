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
        $keyword = $request->get('keyword');

        $searchManager = $this->get('app.service.search_manager');

        $searchManager->setSearchEngine($this->get('app.service.search_engine.kilobaitas.search'));
        $searchManager->setSearchEngine($this->get('app.service.search_engine.skytech.search'));
        $searchManager->setSearchEngine($this->get('app.service.search_engine.one_a.search'));

        $data = $searchManager->search($keyword);

        $response = new JsonResponse($data);
        $response->setEncodingOptions(JSON_PRETTY_PRINT);

        return $response;
    }
}
