<?php

namespace App\Form;

use App\Entity\Signalement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

// CETTE CLASSE n'est PAS utilisé pour le moment puisque que le contenu est inséré manuellement dans _modalSignalement.html.twig
class SignalementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', ChoiceType::class, [
                'label' => 'Signalement',
                'required' => true,
                'choices' => [
                    'Commentaire' => 'commentaire',
                    'Panne' => 'panne',
                    'Qualité' => 'qualite'
                ]
            ])
            ->add('message', TextType::class, [
                'label' => 'Message',
                // 'placeholer' => 'Entrer votre commentaire',
                'required' => true
            ])
            ->add('productionType', TextType::class, [
                "mapped" => false,
                "required" => true
            ]);
        // ->add('submit', SubmitType::class, [
        //     'label' => 'Envoyer',
        //     'attr' => "bg-blue-500 text-white font-bold py-2 px-4 rounded"
        // ])
        // ->add('return', SubmitType::class, [
        //     'label' => 'Envoyer',
        //     'attr' => "bg-gray-500 text-white font-bold py-2 px-4 rounded"
        // ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Signalement::class,
        ]);
    }
}
