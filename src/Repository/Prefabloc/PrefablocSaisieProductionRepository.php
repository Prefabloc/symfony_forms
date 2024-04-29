<?php

namespace App\Repository\Prefabloc;

use App\Entity\Prefabloc\PrefablocSaisieProduction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PrefablocSaisieProduction>
 *
 * @method PrefablocSaisieProduction|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrefablocSaisieProduction|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrefablocSaisieProduction[]    findAll()
 * @method PrefablocSaisieProduction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrefablocSaisieProductionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrefablocSaisieProduction::class);
    }

    //    /**
    //     * @return PrefablocSaisieProduction[] Returns an array of PrefablocSaisieProduction objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?PrefablocSaisieProduction
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
