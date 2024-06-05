<?php
namespace App\Form;

use App\Entity\IdentificationPrestation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IdentificationPrestationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('societe', TextType::class, [
                'label' => 'Société : ',
                'label_attr' => [
                    'class' => 'block text-sm font-medium leading-6 text-gray-900'
                ],
                'attr' => [
                    'class' => 'block w-full rounded-md  border dark:border-gray-600 py-1.5 text-gray-900 shadow-sm  placeholder:text-gray-400  sm:text-sm sm:leading-6'
                ]
            ])
            ->add('nomPrenom', TextType::class, [
                'label' => 'Nom / Prénom : ',
                'label_attr' => [
                    'class' => 'block text-sm font-medium leading-6 text-gray-900'
                ],
                'attr' => [
                    'class' => 'block w-full rounded-md border dark:border-gray-600 py-1.5 text-gray-900 shadow-sm  placeholder:text-gray-400  sm:text-sm sm:leading-6'
                ]
            ])
            ->add('prestation', TextareaType::class, [
                'label' => 'Prestation : ',
                'label_attr' => [
                    'class' => 'block text-sm font-medium leading-6 text-gray-900'
                ],
                'attr' => [
                    'class' => 'block p-2.5 w-full text-sm text-gray-900 bg-white rounded-md border border-gray-300  focus:border-orange-500 dark:bg-white dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-orange-500 dark:focus:border-orange-500'
                ]
            ])
            ->add('commanditaire', TextType::class, [
                'label' => 'Commanditaire : ',
                'label_attr' => [
                    'class' => 'block text-sm font-medium leading-6 text-gray-900'
                ],
                'attr' => [
                    'class' => 'block w-full rounded-md border dark:border-gray-600 py-1.5 text-gray-900 shadow-sm placeholder:text-gray-400 sm:text-sm sm:leading-6'
                ]
            ])
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
            'data_class' => IdentificationPrestation::class,
        ]);
    }
}