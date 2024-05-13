<?php

namespace App\Form\BTP;

use App\Entity\BTP\BTPProduction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BTPProductionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('startedAt', HiddenType::class, ['disabled' => $options['disable_fields']])
            ->add('endedAt', HiddenType::class, ['disabled' => $options['disable_fields']])
            ->add('article', TextType::class)
            ->add('isProcessed', HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BTPProduction::class,
            'disable_fields' => false,
            'articles' => []
        ]);
    }
}
