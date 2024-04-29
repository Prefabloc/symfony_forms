<?php

namespace App\Repository\Agregat;

use App\Entity\Agregat\AgregatConcassageProductionPelle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AgregatConcassageProductionPelle>
 *
 * @method AgregatConcassageProductionPelle|null find($id, $lockMode = null, $lockVersion = null)
 * @method AgregatConcassageProductionPelle|null findOneBy(array $criteria, array $orderBy = null)
 * @method AgregatConcassageProductionPelle[]    findAll()
 * @method AgregatConcassageProductionPelle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgregatConcassageProductionPelleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AgregatConcassageProductionPelle::class);
    }

    public function startProduction($mode)
    {
        $entityManager = $this->getEntityManager();

        $entity = new AgregatConcassageProductionPelle();
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

        $production = $entityManager->find(AgregatConcassageProductionPelle::class, $id);

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
    //     * @return AgregatConcassageProductionPelle[] Returns an array of AgregatConcassageProductionPelle objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?AgregatConcassageProductionPelle
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
