<?php

namespace App\Repository;

use App\Entity\Prefabloc\SaisieProduction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SaisieProduction>
 *
 * @method SaisieProduction|null find($id, $lockMode = null, $lockVersion = null)
 * @method SaisieProduction|null findOneBy(array $criteria, array $orderBy = null)
 * @method SaisieProduction[]    findAll()
 * @method SaisieProduction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SaisieProductionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SaisieProduction::class);
    }

    //    /**
    //     * @return SaisieProduction[] Returns an array of SaisieProduction objects
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

    //    public function findOneBySomeField($value): ?SaisieProduction
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
