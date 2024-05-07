<?php

namespace App\Repository;

use App\Entity\LitigeQualite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\LockMode;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LitigeQualite>
 *
 * @method LitigeQualite|null find($id, $lockMode = null, $lockVersion = null)
 * @method LitigeQualite|null findOneBy(array $criteria, array|null $orderBy = null)
 * @method LitigeQualite[] findAll()
 * @method LitigeQualite[] findBy(array $criteria, array|null $orderBy = null, int|null $limit = null, int|null $offset = null)
 */
class LitigeQualiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LitigeQualite::class);
    }

    //    /**
    //     * @return LitigeQualite[] Returns an array of LitigeQualite objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('l.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?LitigeQualite
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

//    public function insert(LitigeQualite $entity): void
//    {
//        $entityManager = $this->getEntityManager();
//
//        $entityManager->persist($entity);
//        $entityManager->flush();
//    }
}