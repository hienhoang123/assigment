<?php

namespace App\Form;

use App\Entity\Clase;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ClaseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class)
            ->add('major',ChoiceType::class,
            [
                'choices'=>[
                    'IT' => 'IT',
                    'Marketing'=>'Marketing',
                    'Graphic'=>'Graphic',
                    'Business'=>'Business'
                    ],
                    'expanded'=>false
            ])
            ->add('semester',ChoiceType::class,
            [
                'choices'=>[
                    'Spring' => 'Spring',
                    'Summer'=>'Summer',
                    'Fall'=>'Fall',
                    ],
                    'expanded'=>false
            ])
            ->add('number',TextType::class,
            [
                'label'=>'Number of student'
            ])
            ->add('teacher',TextType::class)
            // ->add('students')
            ->add('Save',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Clase::class,
        ]);
    }
}
