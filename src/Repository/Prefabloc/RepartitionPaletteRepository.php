<?php

namespace App\Repository\Prefabloc;

use App\Entity\Prefabloc\RepartitionPalette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RepartitionPalette>
 *
 * @method RepartitionPalette|null find($id, $lockMode = null, $lockVersion = null)
 * @method RepartitionPalette|null findOneBy(array $criteria, array $orderBy = null)
 * @method RepartitionPalette[]    findAll()
 * @method RepartitionPalette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RepartitionPaletteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RepartitionPalette::class);
    }

    //    /**
    //     * @return RepartitionPalette[] Returns an array of RepartitionPalette objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?RepartitionPalette
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
