<?php

namespace App\Repository\Agregat;

use App\Entity\Agregat\CarriereSaisieDebit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CarriereSaisieDebit>
 *
 * @method CarriereSaisieDebit|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarriereSaisieDebit|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarriereSaisieDebit[]    findAll()
 * @method CarriereSaisieDebit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarriereSaisieDebitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarriereSaisieDebit::class);
    }

    //    /**
    //     * @return CarriereSaisieDebit[] Returns an array of CarriereSaisieDebit objects
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

    //    public function findOneBySomeField($value): ?CarriereSaisieDebit
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
