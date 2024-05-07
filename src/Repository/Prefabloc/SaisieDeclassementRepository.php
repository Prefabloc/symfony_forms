<?php

namespace App\Repository\Prefabloc;

use App\Entity\Prefabloc\SaisieDeclassement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SaisieDeclassement>
 *
 * @method SaisieDeclassement|null find($id, $lockMode = null, $lockVersion = null)
 * @method SaisieDeclassement|null findOneBy(array $criteria, array $orderBy = null)
 * @method SaisieDeclassement[]    findAll()
 * @method SaisieDeclassement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SaisieDeclassementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SaisieDeclassement::class);
    }

    //    /**
    //     * @return SaisieDeclassement[] Returns an array of SaisieDeclassement objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?SaisieDeclassement
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
