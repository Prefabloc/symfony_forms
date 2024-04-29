<?php

namespace App\Repository\BTP;

use App\Entity\BTP\BTPProduction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BTPProduction>
 *
 * @method BTPProduction|null find($id, $lockMode = null, $lockVersion = null)
 * @method BTPProduction|null findOneBy(array $criteria, array $orderBy = null)
 * @method BTPProduction[]    findAll()
 * @method BTPProduction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BTPProductionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BTPProduction::class);
    }

    public function startProduction($mode)
    {
        $entityManager = $this->getEntityManager();

        $entity = new BTPProduction();
        $entity->setMode($mode);
        $timezone = new \DateTimeZone('Europe/Moscow'); // Example for UTC+3
        $startedAt = new \DateTime('now', $timezone);

        // Set the endedAt time for the production
        $entity->setStartedAt($startedAt);

        // Persist changes to the database
        $entityManager->persist($entity);
        $entityManager->flush();
    }


    public function findLastActive()
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.startedAt IS NOT NULL')
            ->andWhere('a.endedAt IS NULL')
            ->orderBy('a.startedAt', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function endProduction($id)
    {
        $entityManager = $this->getEntityManager();

        $production = $entityManager->find(BTPProduction::class, $id);

        if ($production === null) {
            throw new \Exception('');
        }

        // Create a DateTime object with UTC+3 time zone
        $timezone = new \DateTimeZone('Europe/Moscow'); // Example for UTC+3
        $endedAt = new \DateTime('now', $timezone);

        // Set the endedAt time for the production
        $production->setEndedAt($endedAt);

        // Persist changes to the database
        $entityManager->persist($production);
        $entityManager->flush();
    }
    //    /**
    //     * @return BTPProduction[] Returns an array of BTPProduction objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?BTPProduction
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
