<?php

namespace App\Repository;

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

    public function findByTerm( string $mot) {
        return $this->createQueryBuilder('a')
            //On cherche dans les labels d'article les noms qui contiendraient le mot qu'on a entré dans la base de données
            ->andWhere('a.label LIKE :mot')
            ->setParameter('mot' , '%'.$mot.'%')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    public function findByTermInPrefabloc( string $mot ) {
        return $this->createQueryBuilder('a')
            //On cherche dans les labels d'article les noms qui contiendraient le mot qu'on a entré dans la base de données
            ->andWhere('a.label LIKE :mot')
            ->andWhere( 'a.societe = :nomSociete ')
            ->setParameter('mot' , '%'.$mot.'%')
            ->setParameter('nomSociete' , '1')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    public function findByTermInBTP( string $mot ) {
        return $this->createQueryBuilder('a')
            ->andWhere('a.label LIKE :mot' )
            ->andWhere('a.societe = :nomSociete')
            ->setParameter('mot' , '%'.$mot.'%')
            ->setParameter('nomSociete' , '7')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
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
