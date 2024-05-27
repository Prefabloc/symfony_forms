<?php

namespace App\Repository\BTP;

use App\Entity\BTP\BTPProduction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BTPProduction>
 *
 * @method BTPProduction|null find($id, $lockMode = null, $lockVersion = null)
 * @method BTPProduction|null findOneBy(array $criteria, array $orderBy = null)
 * @method BTPProduction[]    findAll()
 * @method BTPProduction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BTPProductionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BTPProduction::class);
    }

    public function findLastActive()
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.startedAt IS NOT NULL')
            ->andWhere('a.endedAt IS NULL')
            ->orderBy('a.startedAt', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    //    /**
    //     * @return BTPProduction[] Returns an array of BTPProduction objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?BTPProduction
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
