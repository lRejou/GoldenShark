<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\JsonApi;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(): Response
    {

        $myapi = new JSONAPI("51.75.186.103" , "30581" , "admin" , "changeme");
        
        $myEco = $myapi->call("econ.getBalance" , ["Presussit_in_Ore"]);

        var_dump($myEco);

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
