<?php

namespace App\Repository\Exforman;

use App\Entity\Exforman\SaisieDebit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SaisieDebit>
 *
 * @method SaisieDebit|null find($id, $lockMode = null, $lockVersion = null)
 * @method SaisieDebit|null findOneBy(array $criteria, array $orderBy = null)
 * @method SaisieDebit[]    findAll()
 * @method SaisieDebit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SaisieDebitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SaisieDebit::class);
    }

    //    /**
    //     * @return SaisieDebit[] Returns an array of SaisieDebit objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?SaisieDebit
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
