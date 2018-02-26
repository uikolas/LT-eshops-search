<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        return $this->render('home/index.html.twig');
    }
}
