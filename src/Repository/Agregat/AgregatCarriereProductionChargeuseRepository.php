<?php

namespace App\Repository\Agregat;

use App\Entity\Agregat\AgregatCarriereProductionChargeuse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AgregatCarriereProductionChargeuse>
 *
 * @method AgregatCarriereProductionChargeuse|null find($id, $lockMode = null, $lockVersion = null)
 * @method AgregatCarriereProductionChargeuse|null findOneBy(array $criteria, array $orderBy = null)
 * @method AgregatCarriereProductionChargeuse[]    findAll()
 * @method AgregatCarriereProductionChargeuse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgregatCarriereProductionChargeuseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AgregatCarriereProductionChargeuse::class);
    }

    public function startProduction($mode)
    {
        $entityManager = $this->getEntityManager();

        $entity = new AgregatCarriereProductionChargeuse();
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

        $production = $entityManager->find(AgregatCarriereProductionChargeuse::class, $id);

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
    //     * @return AgregatCarriereProductionChargeuse[] Returns an array of AgregatCarriereProductionChargeuse objects
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

    //    public function findOneBySomeField($value): ?AgregatCarriereProductionChargeuse
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
