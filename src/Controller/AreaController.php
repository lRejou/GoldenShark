<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\LandRepository;
use App\Entity\Land;

use App\Repository\UserRepository;
use App\Entity\User;

use App\Repository\BankTransactionRepository;
use App\Entity\BankTransaction;

use App\Entity\JsonApi;

use Symfony\Component\HttpFoundation\Request;

class AreaController extends AbstractController
{
    /**
     * @Route("/area", name="area")
     */
    public function index(LandRepository $landRepository,UserRepository $userRepository): Response
    {
        $pseudo = "Presussit_in_Ore";
        $player = $userRepository->findOneBy(["pseudo" => $pseudo]);
 
        $areas = $landRepository->findBy(["User" => null], [], 500, 0);

        return $this->render('area/index.html.twig', [
            'areas' => $areas,
            'player' => $player
        ]);
    }

    /**
     * @Route("/area/{number}", name="areaOffset", methods={"GET","POST"})
     */
    public function areaOffset(LandRepository $landRepository,UserRepository $userRepository, Request $request)
    {
        
        $numberAffiche = 500;
        $offset = $numberAffiche * $request->get("number") - 500;

        $pseudo = "Presussit_in_Ore";
        $player = $userRepository->findOneBy(["pseudo" => $pseudo]);

        $areas = $landRepository->findBy([], [], $numberAffiche, $offset);

        



        return $this->render('area/index.html.twig', [
            'areas' => $areas,
            'player' => $player
        ]);
    }

    /**
     * @Route("/areaBuy/{id}", name="areaBuy", methods={"GET","POST"})
     */
    public function areaBuy(LandRepository $landRepository,UserRepository $userRepository, Request $request)
    {
        $pseudo = "Presussit_in_Ore";
        $player = $userRepository->findOneBy(["pseudo" => $pseudo]);
        $prixTerrain = 1000000;


        $bankAccount = $player->getBankAcount();

        $idZone = $request->get("id");
        $zone = $landRepository->findOneBy(["id" => $idZone]);
        if($bankAccount->getMoney() >= $prixTerrain && $zone->getUser() == null){

            $entityManager = $this->getDoctrine()->getManager();

            //Enregitrement de terrain dans la BDD
            $zone->setUser($player);
            $entityManager->persist($zone);
            $entityManager->flush();

            //On débit le joueur
            $money = $bankAccount->getMoney();
            $money = $money - $prixTerrain;
            $bankAccount->setMoney($money);
            $entityManager->persist($bankAccount);
            $entityManager->flush();

            //On ajoute le terrain InGame
            $myapi = new JSONAPI("51.75.186.103" , "30581" , "admin" , "changeme");
            $addMoneyInGame = $myapi->call("runConsoleCommand" , ['region addowner -w "world" '. $zone->getLandId() . ' ' . $pseudo]);

            //Historique d'achat
            $newTransaction = new BankTransaction;
            $newTransaction->setBankAccount($bankAccount);
            $calculTransaction = 0 - $prixTerrain;
            $newTransaction->setAmount($calculTransaction);
            $newTransaction->setInfo("Achat terrain : ".$zone->getLandId());
            $newTransaction->setDatetame(new \DateTime());
            
            $entityManager->persist($newTransaction);
            $entityManager->flush();

        }
        
        return $this->redirectToRoute('area');
    }

    /**
     * @Route("/areaSell/{id}", name="areaSell", methods={"GET","POST"})
     */
    public function areaSell(LandRepository $landRepository,UserRepository $userRepository, Request $request)
    {
        $pseudo = "Presussit_in_Ore";
        $prix = 800000;

        $idZone = $request->get("id");
        $zone = $landRepository->findOneBy(["id" => $idZone]);
        

        $player = $userRepository->findOneBy(["pseudo" => $pseudo]);

        if($zone->getUser() == $player){

            //Suppression de la Zone
            $zone->setUser(null);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($zone);
            $entityManager->flush();

            //On supprime le ownerIngame
            $myapi = new JSONAPI("51.75.186.103" , "30581" , "admin" , "changeme");
            $addMoneyInGame = $myapi->call("runConsoleCommand" , ['region removeowner -w "world" -a '. $zone->getLandId()]);

            // !!!!!! Il faudra supprimer aussi les membre aussi


            //On Rend l'argent à l'utilisateur
            $bankUser = $player->getBankAcount();
            $MoneyUser = $bankUser->getMoney();
            $MoneyUser = $MoneyUser + 800000;
            $bankUser->setMoney($MoneyUser);
            $entityManager->persist($bankUser);
            $entityManager->flush();

            //On ajouter l'historique de transaction
            $newTransaction = new BankTransaction;
            $newTransaction->setBankAccount($bankUser);
            $calculTransaction = $prix;
            $newTransaction->setAmount($calculTransaction);
            $newTransaction->setInfo("Ventre terrain : ".$zone->getLandId());
            $newTransaction->setDatetame(new \DateTime());
            
            $entityManager->persist($newTransaction);
            $entityManager->flush();




        }

        
        
        return $this->redirectToRoute('area');
    }
}
