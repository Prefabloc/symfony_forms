<?php

namespace App\Repository\Exforman;

use App\Entity\Exforman\ExformanProductionAlimentation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ExformanProductionAlimentation>
 *
 * @method ExformanProductionAlimentation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExformanProductionAlimentation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExformanProductionAlimentation[]    findAll()
 * @method ExformanProductionAlimentation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExformanProductionAlimentationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExformanProductionAlimentation::class);
    }

    public function startProduction($mode)
    {
        $entityManager = $this->getEntityManager();

        $entity = new ExformanProductionAlimentation();
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

        $production = $entityManager->find(ExformanProductionAlimentation::class, $id);

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
//     * @return ExformanProductionAlimentation[] Returns an array of ExformanProductionAlimentation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

    //    public function findOneBySomeField($value): ?ExformanProductionAlimentation
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
