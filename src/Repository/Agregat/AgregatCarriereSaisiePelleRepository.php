<?php

namespace App\Repository\Agregat;

use App\Entity\Agregat\AgregatCarriereSaisiePelle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AgregatCarriereSaisiePelle>
 *
 * @method AgregatCarriereSaisiePelle|null find($id, $lockMode = null, $lockVersion = null)
 * @method AgregatCarriereSaisiePelle|null findOneBy(array $criteria, array $orderBy = null)
 * @method AgregatCarriereSaisiePelle[]    findAll()
 * @method AgregatCarriereSaisiePelle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgregatCarriereSaisiePelleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AgregatCarriereSaisiePelle::class);
    }

    //    /**
    //     * @return AgregatCarriereSaisiePelle[] Returns an array of AgregatCarriereSaisiePelle objects
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

    //    public function findOneBySomeField($value): ?AgregatCarriereSaisiePelle
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
