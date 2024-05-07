<?php

namespace App\Repository\Exforman;

use App\Entity\Exforman\SaisieAlimentation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SaisieAlimentation>
 *
 * @method SaisieAlimentation|null find($id, $lockMode = null, $lockVersion = null)
 * @method SaisieAlimentation|null findOneBy(array $criteria, array $orderBy = null)
 * @method SaisieAlimentation[]    findAll()
 * @method SaisieAlimentation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SaisieAlimentationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SaisieAlimentation::class);
    }

    //    /**
    //     * @return SaisieAlimentation[] Returns an array of SaisieAlimentation objects
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

    //    public function findOneBySomeField($value): ?SaisieAlimentation
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
