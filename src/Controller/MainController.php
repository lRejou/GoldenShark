<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\UserRepository;
use App\Entity\User;


use App\Entity\JsonApi;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(UserRepository $userRepository)
    {

        $player = "Presussit_in_Ore";

        //Récupération des informations utilisateur en BDD
        $infoPlayer = $userRepository->findOneBy(["pseudo" => $player]);


        //URL pour le skin
        $UUID = json_decode (file_get_contents('https://api.mojang.com/users/profiles/minecraft/' . $infoPlayer->getPseudo()));
        $srcImg = "https://crafatar.com/renders/body/" . $UUID->id ;


        //Récupération de l'argent InGame
        $myapi = new JSONAPI("51.75.186.103" , "30581" , "admin" , "changeme");
        $myEco = $myapi->call("econ.getBalance" , [$player]);
        $moneyPlayer = json_decode($myEco)[0]->success;



        return $this->render('main/index.html.twig', [
            'urlSkin' => $srcImg,
             'playerName' => $player,
             'infoPlayer' => $infoPlayer,
             'Eco' => $moneyPlayer
        ]);
    }

    /**
     * @Route("/doc", name="documentation")
     */
    public function doc(): Response
    {
        // Avoir un URL pour afficher le skin d'un user
        //API pour les skins https://crafatar.com/
        $player = "Maqueux";
        $UUID = json_decode (file_get_contents('https://api.mojang.com/users/profiles/minecraft/' . $player));
        $srcImg = "https://crafatar.com/renders/body/" . $UUID->id ;

        return $this->render('main/documentation.html.twig', ["srcImg" => $srcImg]);
    }
}
