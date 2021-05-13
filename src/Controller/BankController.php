<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;

use App\Repository\UserRepository;
use App\Entity\User;

use App\Repository\BankTransactionRepository;
use App\Entity\BankTransaction;

use App\Repository\BankAccountStatsRepository;
use App\Entity\BankAccountStats;


use App\Entity\JsonApi;

class BankController extends AbstractController
{
    /**
     * @Route("/bank", name="bank")
     */
    public function index(UserRepository $userRepository, BankAccountStatsRepository $bankAccountStatsRepository)
    {
        $playerPseudo = "Presussit_in_Ore";

        //Récupération des informations utilisateur en BDD
        $player = $userRepository->findOneBy(["pseudo" => $playerPseudo]);


        //BUG WTF ! ça marche pas
        //Récupération de l'argent InGame
        $myapi = new JSONAPI("51.75.186.103" , "30581" , "admin" , "changeme");
        $myEco = $myapi->call("econ.getBalance" , [$playerPseudo]);
        $moneyPlayer = json_decode($myEco)[0]->success;

        //Récupération des transactions
        $playerTransaction = $player->getBankAcount()->getBankTransaction();

        //Recupération des stats jour par jour
        $date = $bankAccountStatsRepository->findBy(["bankAccount" => $player->getBankAcount()] , ["date" => "ASC"], 31);


        return $this->render('bank/index.html.twig', [
            "player" => $player,
            "moneyPlayer" => $moneyPlayer,
            "playerTransactions" => $playerTransaction,
            "dates" => $date
        ]);
    }

    /**
     * @Route("/bank/virement/bank/minecraft", name="bank_virement_bank_minecraft")
     */
    public function bankVirementBankMinecraft(UserRepository $userRepository,BankTransactionRepository $bankTransactionRepository, Request $request)
    {
        $playerPseudo = "Presussit_in_Ore";

        //Récupération des informations utilisateur en BDD
        $player = $userRepository->findOneBy(["pseudo" => $playerPseudo]);

        //Récupération de l'argent InGame
        $myapi = new JSONAPI("51.75.186.103" , "30581" , "admin" , "changeme");
        $myEco = $myapi->call("econ.getBalance" , [$playerPseudo]);
        $moneyPlayer = json_decode($myEco)[0]->success;

        //Récupération de l'input moneyTransaction du formulaire
        $moneyTransaction = $request->get('moneyTransaction');

        //Money Sur le site
        $MoneyInWebSite = $player->getBankAcount()->getMoney();

        if($moneyTransaction <= $MoneyInWebSite){

            //initialisation de l'entity manager pour pouvoir intervenir dans la BDD
            $entityManager = $this->getDoctrine()->getManager();

            //On envoie l'argent sur minecraft
            $addMoneyInGame = $myapi->call("runConsoleCommand" , ["eco give ". $playerPseudo . " " . $moneyTransaction]);

            //On supprime l'argent du compte de l'utilisateur
            $MoneyInWebSite = $MoneyInWebSite - $moneyTransaction;
            $BankAccount = $player->getBankAcount();
            $BankAccount->setMoney($MoneyInWebSite);
            $player->setBankAcount($BankAccount);

            //Modification de la BDD
            $entityManager->persist($player);
            $entityManager->flush();


            /*===========Historique=============*/
            
            $newTransaction = new BankTransaction;
            $newTransaction->setBankAccount($BankAccount);
            $calculTransaction = 0 - $moneyTransaction;
            $newTransaction->setAmount($calculTransaction);
            $newTransaction->setInfo("Banque -> Minecraft");
            $newTransaction->setDatetame(new \DateTime());
            
            $entityManager->persist($newTransaction);
            $entityManager->flush();




        }



        return $this->redirectToRoute('bank');
    }


    /**
     * @Route("/bank/virement/minecraft/bank", name="bank_virement_minecraft_bank")
     */
    public function bankVirementMinecraftBank(UserRepository $userRepository,BankTransactionRepository $bankTransactionRepository, Request $request)
    {
        $playerPseudo = "Presussit_in_Ore";

        //Récupération des informations utilisateur en BDD
        $player = $userRepository->findOneBy(["pseudo" => $playerPseudo]);

        //Récupération de l'argent InGame
        $myapi = new JSONAPI("51.75.186.103" , "30581" , "admin" , "changeme");
        $myEco = $myapi->call("econ.getBalance" , [$playerPseudo]);
        $moneyPlayer = json_decode($myEco)[0]->success;

        //Récupération de l'input moneyTransaction du formulaire
        $moneyTransaction = $request->get('moneyTransaction');

        //Money Sur le site
        $MoneyInWebSite = $player->getBankAcount()->getMoney();

        if($moneyTransaction <= $moneyPlayer){

            //initialisation de l'entity manager pour pouvoir intervenir dans la BDD
            $entityManager = $this->getDoctrine()->getManager();

            //On Supprime l'argent sur minecraft
            $addMoneyInGame = $myapi->call("runConsoleCommand" , ["eco take ". $playerPseudo . " " . $moneyTransaction]);

            //On ajoute l'argent du compte de l'utilisateur
            $MoneyInWebSite = $MoneyInWebSite + $moneyTransaction;
            $BankAccount = $player->getBankAcount();
            $BankAccount->setMoney($MoneyInWebSite);
            $player->setBankAcount($BankAccount);

            //Modification de la BDD
            $entityManager->persist($player);
            $entityManager->flush();


            /*===========Historique=============*/
            
            $newTransaction = new BankTransaction;
            $newTransaction->setBankAccount($BankAccount);
            $calculTransaction = 0 + $moneyTransaction;
            $newTransaction->setAmount($calculTransaction);
            $newTransaction->setInfo("Minecraft -> Banque");
            $newTransaction->setDatetame(new \DateTime());
            
            $entityManager->persist($newTransaction);
            $entityManager->flush();




        }



        return $this->redirectToRoute('bank');
    }
}
