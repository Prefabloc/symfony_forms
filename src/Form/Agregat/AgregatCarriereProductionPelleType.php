<?php

namespace App\Form\Agregat;

use App\Entity\Agregat\AgregatCarriereProductionPelle;
use App\Entity\Mode;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgregatCarriereProductionPelleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('startedAt', HiddenType::class, ['disabled' => $options['disable_fields']])
            ->add('endedAt', HiddenType::class, ['disabled' => $options['disable_fields']])
            ->add('mode' , EntityType::class, [
                "label" => "Mode : ",
                'label_attr' => [
                    'class' => "block text-sm font-medium leading-6 text-gray-900"
                ],
                'class' => Mode::class,
                'placeholder' => '-- Choisissez un mode --' ,
                'attr' => [
                    'class' => "bg-neutral-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus: block w-full p-2.5"
                ],
                "required" => true,
                'choice_label' => 'nom' ,
                'query_builder' => function ( EntityRepository $er ) {
                    return $er->createQueryBuilder('m')
                        ->where('m.affiliation LIKE :type')
                        ->setParameter( 'type' ,'%' . 'AgregatCarriereProductionPelle' . '%');
                }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AgregatCarriereProductionPelle::class,
            'disable_fields' => false,
        ]);
    }
}
