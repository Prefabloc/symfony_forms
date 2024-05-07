<?php

namespace App\Repository\Valromex;

use App\Entity\Valromex\ValromexSaisieProduction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ValromexSaisieProduction>
 *
 * @method ValromexSaisieProduction|null find($id, $lockMode = null, $lockVersion = null)
 * @method ValromexSaisieProduction|null findOneBy(array $criteria, array $orderBy = null)
 * @method ValromexSaisieProduction[]    findAll()
 * @method ValromexSaisieProduction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ValromexSaisieProductionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ValromexSaisieProduction::class);
    }

    //    /**
    //     * @return ValromexSaisieProduction[] Returns an array of ValromexSaisieProduction objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('v.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ValromexSaisieProduction
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
