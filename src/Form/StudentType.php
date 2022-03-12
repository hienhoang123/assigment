<?php

namespace App\Form;

use App\Entity\Clase;
use App\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class)
            ->add('address',TextType::class)
            ->add('phone',TextType::class)
            ->add('birth',DateType::class)
            ->add('email',TextType::class)
            ->add('image',TextType::class)
            ->add('clase',EntityType::class,
            [
                'class'=>Clase::class,
                'choice_label'=>'name',
                'multiple'=>true,
                'expanded'=>false
            ])
            ->add('Save',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
