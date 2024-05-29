<?php

namespace App\Form;

use App\Entity\Pointage;
use App\Entity\Site;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PointageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('arrivedAt', TextType::class, [
                'attr' => [
                    'readonly' => true
                ]
            ])
            ->add('departedAt', null, [
                'attr' => [
                    'readonly' => true
                ]
            ])
            ->add('site', TextType::class , [
                'attr' => [
                    'readonly' => true
                ]
            ] )
            ->add('employe', TextType::class, [
                'attr' => [
                    'readonly' => true
                ]
            ] )
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => "bg-orange-900 hover:bg-orange-500 text-white font-bold py-2 px-4 rounded"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pointage::class,
        ]);
    }
}
