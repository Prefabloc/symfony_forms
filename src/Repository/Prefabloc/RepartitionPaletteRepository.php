<?php

namespace App\Repository\Prefabloc;

use App\Entity\Prefabloc\ReparationPalette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReparationPalette>
 *
 * @method ReparationPalette|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReparationPalette|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReparationPalette[]    findAll()
 * @method ReparationPalette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RepartitionPaletteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReparationPalette::class);
    }

    //    /**
    //     * @return ReparationPalette[] Returns an array of ReparationPalette objects
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

    //    public function findOneBySomeField($value): ?ReparationPalette
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
