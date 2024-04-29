<?php

namespace App\Repository\Prefabloc;

use App\Entity\ProductionArticle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductionArticle>
 *
 * @method ProductionArticle|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductionArticle|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductionArticle[]    findAll()
 * @method ProductionArticle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductionArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductionArticle::class);
    }

    public function findBySociete(int $societeId)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.societe = :val')
            ->setParameter('val', $societeId)
            ->orderBy('p.id', 'ASC')
            // ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    //    /**
//     * @return ProductionArticle[] Returns an array of ProductionArticle objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

    //    public function findOneBySomeField($value): ?ProductionArticle
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
