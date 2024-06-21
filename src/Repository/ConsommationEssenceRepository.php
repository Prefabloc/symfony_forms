<?php

namespace App\Repository;

use App\Entity\ConsommationEssence;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ConsommationEssence>
 *
 * @method ConsommationEssence|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConsommationEssence|null findOneBy(array $criteria, array|null $orderBy = null)
 * @method ConsommationEssence[] findAll()
 * @method ConsommationEssence[] findBy(array $criteria, array|null $orderBy = null, int|null $limit = null, int|null $offset = null)
 */
class ConsommationEssenceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConsommationEssence::class);
    }

    public function getLastElement($machine): ?ConsommationEssence
    {
        $result = $this->createQueryBuilder('a')
            ->andWhere('a.machine = :machine') // Use the 'id' of the machine entity
            ->andWhere('a.isValidated = :validated')
            ->setParameter('validated', 0)
            ->setParameter('machine', $machine)
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        return $result;
    }

    //    public function findDistinctTypes(): array
//    {
//        $queryBuilder = $this->createQueryBuilder('m');
//
//        $queryBuilder
//            ->select('m.label')
//            ->distinct();
//
//        $query = $queryBuilder->getQuery();
//
//        return $query->getResult();
//    }
    //    /**
    //     * @return ConsommationEssence[] Returns an array of ConsommationEssence objects
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

    //    public function findOneBySomeField($value): ?ConsommationEssence
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
