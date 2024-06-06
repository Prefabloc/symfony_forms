<?php

namespace App\Repository;

use App\Entity\MotifDeclassement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MotifDeclassement>
 *
 * @method MotifDeclassement|null find($id, $lockMode = null, $lockVersion = null)
 * @method MotifDeclassement|null findOneBy(array $criteria, array $orderBy = null)
 * @method MotifDeclassement[]    findAll()
 * @method MotifDeclassement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MotifDeclassementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MotifDeclassement::class);
    }

    //    /**
    //     * @return MotifDeclassement[] Returns an array of MotifDeclassement objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?MotifDeclassement
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
