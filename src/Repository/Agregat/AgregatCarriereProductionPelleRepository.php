<?php

namespace App\Repository\Agregat;

use App\Entity\Agregat\AgregatCarriereProductionPelle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AgregatCarriereProductionPelle>
 *
 * @method AgregatCarriereProductionPelle|null find($id, $lockMode = null, $lockVersion = null)
 * @method AgregatCarriereProductionPelle|null findOneBy(array $criteria, array $orderBy = null)
 * @method AgregatCarriereProductionPelle[]    findAll()
 * @method AgregatCarriereProductionPelle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgregatCarriereProductionPelleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AgregatCarriereProductionPelle::class);
    }


    public function startProduction($mode)
    {
        $entityManager = $this->getEntityManager();

        $entity = new AgregatCarriereProductionPelle();
        $entity->setMode($mode);
        $timezone = new \DateTimeZone('Indian/Reunion');
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

        $production = $entityManager->find(AgregatCarriereProductionPelle::class, $id);

        if ($production === null) {
            throw new \Exception('');
        }

        // Create a DateTime object with UTC+3 time zone
        $timezone = new \DateTimeZone('Indian/Reunion');
        $endedAt = new \DateTime('now', $timezone);

        // Set the endedAt time for the production
        $production->setEndedAt($endedAt);

        // Persist changes to the database
        $entityManager->persist($production);
        $entityManager->flush();
    }

    //    /**
    //     * @return AgregatCarriereProductionPelle[] Returns an array of AgregatCarriereProductionPelle objects
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

    //    public function findOneBySomeField($value): ?AgregatCarriereProductionPelle
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
