<?php

namespace App\Repository;

use App\Entity\ConsommationMachine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ConsommationMachine>
 *
 * @method ConsommationMachine|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConsommationMachine|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConsommationMachine[]    findAll()
 * @method ConsommationMachine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConsommationMachineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConsommationMachine::class);
    }

//        public function findDistinctTypes(): array
//        {
//            return $this->createQueryBuilder('c')
//                ->select('c.type')
//                ->distinct()
//                ->getQuery()
//                ->getResult()
//            ;
//        }

    //    public function findOneBySomeField($value): ?ConsommationMachine
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
