<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function findByTerm(string $mot, int $societeId)
    {
        return $this->createQueryBuilder('a')
            //On cherche dans les labels d'article les noms qui contiendraient le mot qu'on a entré dans la base de données
            ->andWhere('a.label LIKE :mot')
            ->andWhere('a.societe = :val')
            ->setParameter('mot', '%' . $mot . '%')
            ->setParameter('val', $societeId)
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    public function findInBetonExforman( string $mot , int $idSociete )
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.label LIKE :mot')
            ->andWhere('a.societe = :val')
            ->andWhere('a.typeArticle = :val2')
            ->setParameter( 'mot' , '%' . $mot . '%')
            ->setParameter( 'val' , $idSociete)
            ->setParameter( 'val2' , 'Béton')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    public function findInPalettes( string $mot , int $societeId )
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.label LIKE :mot')
            ->andWhere( 'a.societe = :val')
            ->andWhere( 'a.typeArticle = :val2' )
            ->setParameter( 'mot' , '%' . $mot . '%')
            ->setParameter( 'val' , $societeId )
            ->setParameter( 'val2' , 'Palettes' )
            ->setMaxResults( 10 )
            ->getQuery()
            ->getResult();
    }

    //    /**
//     * @return Article[] Returns an array of Article objects
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

    //    public function findOneBySomeField($value): ?Article
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
