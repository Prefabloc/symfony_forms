<?php

namespace App\Repository\Prefabloc;

use App\Entity\Prefabloc\PrefablocProduction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PrefablocProduction>
 *
 * @method PrefablocProduction|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrefablocProduction|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrefablocProduction[]    findAll()
 * @method PrefablocProduction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrefablocProductionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrefablocProduction::class);
    }
    public function startProduction($mode)
    {
        $entityManager = $this->getEntityManager();

        $entity = new PrefablocProduction();
        $entity->setMode($mode);
        $timezone = new \DateTimeZone('Europe/Moscow'); // Example for UTC+3
        $startedAt = new \DateTime('now', $timezone);

        // Set the endedAt time for the production
        $entity->setStartedAt($startedAt);
        $entity->setProcessedAt(null);

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

        $production = $entityManager->find(PrefablocProduction::class, $id);

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
    //     * @return PrefablocProduction[] Returns an array of PrefablocProduction objects
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

    //    public function findOneBySomeField($value): ?PrefablocProduction
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
