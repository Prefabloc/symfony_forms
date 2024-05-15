<?php

namespace App\Repository;

use App\Entity\IdentificationPrestation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<IdentificationPrestation>
 *
 * @method IdentificationPrestation|null find($id, $lockMode = null, $lockVersion = null)
 * @method IdentificationPrestation|null findOneBy(array $criteria, array $orderBy = null)
 * @method IdentificationPrestation[]    findAll()
 * @method IdentificationPrestation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IdentificationPrestationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IdentificationPrestation::class);
    }

    //    /**
    //     * @return IdentificationPrestation[] Returns an array of IdentificationPrestation objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('i.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?IdentificationPrestation
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
