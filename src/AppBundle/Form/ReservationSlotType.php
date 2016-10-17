<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ReservationSlotType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateTimeType::class, ['label' => 'Kdy: '])
            ->add('location', TextType::class, ['label' => 'Kde: ', 'required' => false])
            ->add('lector', TextType::class, ['label' => 'S kym: ', 'required' => false])
            ->add('level', TextType::class, ['label' => 'Pro koho: ', 'required' => false])
            ->add('capacity', TextType::class, ['label' => 'Kapacita: '])
            ->add('note', TextareaType::class, ['label' => 'Poznamka: ', 'required' => false])
            ->add('save', SubmitType::class, ['label' => 'Vytvorit']);
    }
}
