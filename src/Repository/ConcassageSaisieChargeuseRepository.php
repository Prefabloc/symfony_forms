<?php

namespace App\Repository;

use App\Entity\Agregat\ConcassageSaisieChargeuse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ConcassageSaisieChargeuse>
 *
 * @method ConcassageSaisieChargeuse|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConcassageSaisieChargeuse|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConcassageSaisieChargeuse[]    findAll()
 * @method ConcassageSaisieChargeuse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConcassageSaisieChargeuseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConcassageSaisieChargeuse::class);
    }

    //    /**
    //     * @return ConcassageSaisieChargeuse[] Returns an array of ConcassageSaisieChargeuse objects
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

    //    public function findOneBySomeField($value): ?ConcassageSaisieChargeuse
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
