<?php

namespace App\Form;

use App\Entity\LitigeQualite;
use App\Entity\Societe;
use App\Repository\SocieteRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LitigeQualiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('societe', EntityType::class, [
                'label' => 'Société',
                'required' => true,
                'placeholder' => '-- Sélectionner votre société --',
                'class' => Societe::class,
                'choice_label' => 'label',
                'query_builder' => function (SocieteRepository $societeRepository) {
                    return $societeRepository->createQueryBuilder('s')->orderBy('s.label', 'ASC');
                }
            ])
            ->add('clients', TextType::class, [
                'label' => 'Client',
                'required' => true
            ])
            ->add('blv', TextType::class, [
                'label' => 'BLV',
                'required' => true
            ])
            ->add('article', TextType::class, ['required' => true])
            ->add('volume', IntegerType::class, ['required' => true])
            ->add('conformite', TextType::class, [
                'label' => 'Non Conformité',
                'required' => true
            ])
            ->add('valider', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => "bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LitigeQualite::class,
        ]);
    }
}