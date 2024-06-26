<?php

namespace App\Repository\Prefabloc;

use App\Entity\Prefabloc\PrefablocProduction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PrefablocProduction>
 *
 * @method PrefablocProduction|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrefablocProduction|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrefablocProduction[]    findAll()
 * @method PrefablocProduction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrefablocProductionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrefablocProduction::class);

    }



    public function findLastActive()
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.article IS NOT NULL')
            ->andWhere('a.consommation IS NULL OR a.consommationInfo IS NULL')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }



    //    /**
    //     * @return PrefablocProduction[] Returns an array of PrefablocProduction objects
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

    //    public function findOneBySomeField($value): ?PrefablocProduction
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
