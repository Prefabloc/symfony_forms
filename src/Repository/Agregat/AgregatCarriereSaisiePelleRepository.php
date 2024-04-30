<?php

namespace App\Repository\Agregat;

use App\Entity\Agregat\CarriereSaisiePelle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CarriereSaisiePelle>
 *
 * @method CarriereSaisiePelle|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarriereSaisiePelle|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarriereSaisiePelle[]    findAll()
 * @method CarriereSaisiePelle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgregatCarriereSaisiePelleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarriereSaisiePelle::class);
    }

    //    /**
    //     * @return CarriereSaisiePelle[] Returns an array of CarriereSaisiePelle objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?CarriereSaisiePelle
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
