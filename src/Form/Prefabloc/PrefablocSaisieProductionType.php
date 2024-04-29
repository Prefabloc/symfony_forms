<?php

namespace App\Form\Prefabloc;

use App\Entity\Prefabloc\PrefablocProduction;
use App\Entity\Prefabloc\PrefablocSaisieProduction;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrefablocSaisieProductionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('zero_quatre')
            ->add('six_dix')
            ->add('cem')
            ->add('adjuvant')
            ->add('huile')
            ->add('eau')
            ->add('production', HiddenType::class, []);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PrefablocSaisieProduction::class
        ]);
    }
}
