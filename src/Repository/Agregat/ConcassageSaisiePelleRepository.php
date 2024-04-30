<?php

namespace App\Repository\Agregat;

use App\Entity\Agregat\ConcassageSaisiePelle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ConcassageSaisiePelle>
 *
 * @method ConcassageSaisiePelle|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConcassageSaisiePelle|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConcassageSaisiePelle[]    findAll()
 * @method ConcassageSaisiePelle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConcassageSaisiePelleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConcassageSaisiePelle::class);
    }

    //    /**
    //     * @return ConcassageSaisiePelle[] Returns an array of ConcassageSaisiePelle objects
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

    //    public function findOneBySomeField($value): ?ConcassageSaisiePelle
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
