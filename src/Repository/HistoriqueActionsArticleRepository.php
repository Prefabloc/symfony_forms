<?php

namespace App\Repository;

use App\Entity\HistoriqueActionsArticle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HistoriqueActionsArticle>
 *
 * @method HistoriqueActionsArticle|null find($id, $lockMode = null, $lockVersion = null)
 * @method HistoriqueActionsArticle|null findOneBy(array $criteria, array $orderBy = null)
 * @method HistoriqueActionsArticle[]    findAll()
 * @method HistoriqueActionsArticle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistoriqueActionsArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HistoriqueActionsArticle::class);
    }

    //    /**
    //     * @return HistoriqueActionsArticle[] Returns an array of HistoriqueActionsArticle objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('h')
    //            ->andWhere('h.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('h.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?HistoriqueActionsArticle
    //    {
    //        return $this->createQueryBuilder('h')
    //            ->andWhere('h.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
