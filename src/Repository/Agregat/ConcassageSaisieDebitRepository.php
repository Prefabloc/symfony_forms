<?php

namespace App\Repository\Agregat;

use App\Entity\Agregat\ConcassageSaisieDebit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ConcassageSaisieDebit>
 *
 * @method ConcassageSaisieDebit|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConcassageSaisieDebit|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConcassageSaisieDebit[]    findAll()
 * @method ConcassageSaisieDebit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConcassageSaisieDebitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConcassageSaisieDebit::class);
    }

    //    /**
    //     * @return ConcassageSaisieDebit[] Returns an array of ConcassageSaisieDebit objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ConcassageSaisieDebit
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
