<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ReservationSlotType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->

        $builder
            ->add('sport', ChoiceType::class, [ "choice" ] )
            ->add('date', DateTimeType::class, ['label' => 'Kdy: ',
                'date_widget' => 'single_text',
                'time_widget' => 'choice',
                'minutes' => [0, 5, 10, 15, 20, 25, 30, 35, 40, 45, 50, 55]
            ])
            ->add('location', TextType::class, ['label' => 'Kde: ', 'required' => false])
            ->add('lector', TextType::class, ['label' => 'S kým: ', 'required' => false])
            ->add('level', TextType::class, ['label' => 'Pro koho: ', 'required' => false])
            ->add('capacity', TextType::class, ['label' => 'Kapacita: '])
            ->add('note', TextareaType::class, ['label' => 'Poznámka: ', 'required' => false])
            ->add('save', SubmitType::class, ['label' => 'Uložit', 'attr' => ['class' => 'btn-outline-success'] ]);
    }
}
