<?php

namespace App\Repository;

use App\Entity\BankAccountStats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BankAccountStats|null find($id, $lockMode = null, $lockVersion = null)
 * @method BankAccountStats|null findOneBy(array $criteria, array $orderBy = null)
 * @method BankAccountStats[]    findAll()
 * @method BankAccountStats[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BankAccountStatsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BankAccountStats::class);
    }

    // /**
    //  * @return BankAccountStats[] Returns an array of BankAccountStats objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BankAccountStats
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
