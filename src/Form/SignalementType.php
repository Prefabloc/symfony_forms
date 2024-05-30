<?php

namespace App\Form;

use App\Entity\Signalement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SignalementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', ChoiceType::class, [
                'label' => 'Signalement',
                'required' => true,
                'choices' => [
                    'Commentaire' =>'commentaire',
                    'Panne' =>'panne',
                    'Qualité' =>'qualite'
                ]
            ])
            ->add('message', TextType::class, [
                'label' => 'Message',
                'placeholer' => 'Entrer votre commentaire',
                'required' => true
            ])
            ->add('submit', SignalementType::class, [
                'label' => 'Envoyer',
                'attr' => "bg-blue-500 text-white font-bold py-2 px-4 rounded"
            ])
            ->add('return', SignalementType::class, [
                'label' => 'Envoyer',
                'attr' => "bg-gray-500 text-white font-bold py-2 px-4 rounded"
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Signalement::class,
        ]);
    }
}
