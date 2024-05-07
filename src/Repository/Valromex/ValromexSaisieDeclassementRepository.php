<?php

namespace App\Repository\Valromex;

use App\Entity\Valromex\ValromexSaisieDeclassement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ValromexSaisieDeclassement>
 *
 * @method ValromexSaisieDeclassement|null find($id, $lockMode = null, $lockVersion = null)
 * @method ValromexSaisieDeclassement|null findOneBy(array $criteria, array $orderBy = null)
 * @method ValromexSaisieDeclassement[]    findAll()
 * @method ValromexSaisieDeclassement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ValromexSaisieDeclassementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ValromexSaisieDeclassement::class);
    }

    //    /**
    //     * @return ValromexSaisieDeclassement[] Returns an array of ValromexSaisieDeclassement objects
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

    //    public function findOneBySomeField($value): ?ValromexSaisieDeclassement
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
