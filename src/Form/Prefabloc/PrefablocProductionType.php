<?php

namespace App\Form\Prefabloc;

use App\Entity\Prefabloc\PrefablocProduction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrefablocProductionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('startedAt', HiddenType::class, ['disabled' => $options['disable_fields']])
            ->add('endedAt', HiddenType::class, ['disabled' => $options['disable_fields']])
            ->add('mode', ChoiceType::class, [
                "choices" => $options['articles'],  // Use articles from the options
                'disabled' => $options['disable_fields']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PrefablocProduction::class,
            'disable_fields' => false,
            'articles' => []
        ]);
    }
}
