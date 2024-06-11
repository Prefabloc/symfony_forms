<?php

namespace App\Repository;

use App\Entity\ConsommationMachine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ConsommationMachine>
 */
class ConsommationMachineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConsommationMachine::class);
    }

    public function findDistinctTypes(): array
    {
        $queryBuilder = $this->createQueryBuilder('m');

        $queryBuilder
            ->select('m.label')
            ->distinct();

        $query = $queryBuilder->getQuery();

        return $query->getResult();
    }

//    function (ConsommationMachineRepository $entityRepository) use ($options) {
//                    return $entityRepository->createQueryBuilder('m')
//                                            ->where('m.type = :type')
//                                            ->setParameter('type', $options['type_machine'])
//                                            ->orderBy('m.label', 'ASC');
}
