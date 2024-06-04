<?php

namespace App\Entity\Agregat;

use App\Entity\ProductionForm;
use App\Repository\AgregatConcassageProductionChargeuseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgregatConcassageProductionChargeuseRepository::class)]
class AgregatConcassageProductionChargeuse extends ProductionForm
{

}
