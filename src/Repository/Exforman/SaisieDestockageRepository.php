<?php

namespace App\Repository\Exforman;

use App\Entity\Exforman\SaisieDestockage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SaisieDestockage>
 *
 * @method SaisieDestockage|null find($id, $lockMode = null, $lockVersion = null)
 * @method SaisieDestockage|null findOneBy(array $criteria, array $orderBy = null)
 * @method SaisieDestockage[]    findAll()
 * @method SaisieDestockage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SaisieDestockageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SaisieDestockage::class);
    }

    //    /**
    //     * @return SaisieDestockage[] Returns an array of SaisieDestockage objects
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

    //    public function findOneBySomeField($value): ?SaisieDestockage
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
