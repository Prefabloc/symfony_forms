<?php

namespace App\Repository\Agregat;

use App\Entity\Agregat\AgregatCarriereProductionMobile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AgregatCarriereProductionMobile>
 *
 * @method AgregatCarriereProductionMobile|null find($id, $lockMode = null, $lockVersion = null)
 * @method AgregatCarriereProductionMobile|null findOneBy(array $criteria, array $orderBy = null)
 * @method AgregatCarriereProductionMobile[]    findAll()
 * @method AgregatCarriereProductionMobile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgregatCarriereProductionMobileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AgregatCarriereProductionMobile::class);
    }

    public function startProduction($etage1, $etage2, $etage3)
    {
        $entityManager = $this->getEntityManager();

        $entity = new AgregatCarriereProductionMobile();
        $entity->setEtage1($etage1);
        $entity->setEtage2($etage2);
        $entity->setEtage3($etage3);

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

        $production = $entityManager->find(AgregatCarriereProductionMobile::class, $id);

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
    //     * @return AgregatCarriereProductionMobile[] Returns an array of AgregatCarriereProductionMobile objects
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

    //    public function findOneBySomeField($value): ?AgregatCarriereProductionMobile
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
