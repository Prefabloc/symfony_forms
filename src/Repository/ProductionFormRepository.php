<?php

namespace App\Repository;

use App\Entity\Agregat\AgregatCarriereProductionChargeuse;
use App\Entity\Agregat\AgregatCarriereProductionMobile;
use App\Entity\Agregat\AgregatCarriereProductionPelle;
use App\Entity\Agregat\AgregatConcassageProductionChargeuse;
use App\Entity\Agregat\AgregatConcassageProductionPelle;
use App\Entity\BTP\BTPProduction;
use App\Entity\Exforman\ExformanProductionAlimentation;
use App\Entity\Prefabloc\PrefablocProduction;
use App\Entity\ProductionForm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductionForm>
 *
 * @method Societe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Societe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Societe[]    findAll()
 * @method Societe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductionFormRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductionForm::class);
    }

    public function findLastActiveByType(string $type): ?ProductionForm
    {
        // Permet de récupérer le bon type d'entité grâce a sont discriminant
        $entityClassMap = [
            "prefabloc" => PrefablocProduction::class,
            "btpvalromex" => BTPProduction::class,
            "exforman" => ExformanProductionAlimentation::class,
            "agregat_carriere_chargeuse" => AgregatCarriereProductionChargeuse::class,
            "agregat_carriere_mobile" => AgregatCarriereProductionMobile::class,
            "agregat_carriere_pelle" => AgregatCarriereProductionPelle::class,
            "agregat_concassage_chargeuse" => AgregatConcassageProductionChargeuse::class,
            "agregat_concassage_pelle" => AgregatConcassageProductionPelle::class
        ];

        if (!isset($entityClassMap[$type])) {
            throw new \InvalidArgumentException("Invalid production type: $type");
        }

        // Doctrine Query Langage
        $dql = "
            SELECT production
            FROM {$entityClassMap[$type]} production
            WHERE production.startedAt IS NOT NULL
              AND production.endedAt IS NULL
            ORDER BY production.id DESC
        ";

        return $this->getEntityManager()
            ->createQuery($dql)
            ->setMaxResults(1)
            ->getOneOrNullResult();
    }


    // public function findLastActive()
    // {
    //     return $this->createQueryBuilder('a')
    //         ->andWhere('a.startedAt IS NOT NULL')
    //         ->andWhere('a.endedAt IS NULL')
    //         ->orderBy('a.startedAt', 'DESC')
    //         ->setMaxResults(1)
    //         ->getQuery()
    //         ->getOneOrNullResult();
    // }


    //    /**
    //     * @return Societe[] Returns an array of Societe objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Societe
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
