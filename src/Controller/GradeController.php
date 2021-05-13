<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;

use App\Repository\UserRepository;
use App\Entity\User;

use App\Repository\GradeRepository;
use App\Entity\Grade;

use App\Repository\BankTransactionRepository;
use App\Entity\BankTransaction;

class GradeController extends AbstractController
{
    /**
     * @Route("/grade", name="grade")
     */
    public function index(UserRepository $userRepository, GradeRepository $gradeRepository): Response
    {
        $pseudo = "Presussit_in_Ore";

        $player = $userRepository->findOneBy(["pseudo" => $pseudo]);
        $grades = $gradeRepository->findAll();

        


        return $this->render('grade/index.html.twig',[
            "player" => $player,
            "grades" => $grades
        ]);
    }

    /**
     * @Route("/grade/buy", name="grade_buy")
     */
    public function gradeBuy(UserRepository $userRepository, GradeRepository $gradeRepository): Response
    {
        $pseudo = "Presussit_in_Ore";

        $player = $userRepository->findOneBy(["pseudo" => $pseudo]);

        $gradeUser = $player->getGrade();
        $futureGrade = $gradeRepository->findOneBy(["priority" => $gradeUser->getPriority() + 1 ]);

        if( $player->getBankAcount()->getMoney() >= $futureGrade->getPrice()){
            $entityManager = $this->getDoctrine()->getManager();

            //définition du grade
            $player->setGrade($futureGrade);
            $entityManager->persist($player);
            $entityManager->flush();

            //!!!!! Ajouter le gradeIngame


            //Prendre l'argent du User
            $BankUser = $player->getBankAcount();
            $moneyUser = $BankUser->getMoney();
            $moneyUser = $moneyUser - $futureGrade->getPrice();
            $BankUser->setMoney($moneyUser);
            $entityManager->persist($BankUser);
            $entityManager->flush();

            //Ajouter dans l'historique
            $newTransaction = new BankTransaction;
            $newTransaction->setBankAccount($BankUser);
            $calculTransaction = 0 - $futureGrade->getPrice();
            $newTransaction->setAmount($calculTransaction);
            $newTransaction->setInfo("Achat grade : " . $futureGrade->getName());
            $newTransaction->setDatetame(new \DateTime());
            
            $entityManager->persist($newTransaction);
            $entityManager->flush();
        }


        
        


        return $this->redirectToRoute('grade');
    }
}
