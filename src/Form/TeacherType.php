<?php

namespace App\Form;

use App\Entity\Subject;
use App\Entity\Teacher;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;

class TeacherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('address', ChoiceType::class,
            [
                'choices' => [
                    'Ha Noi' => 'Ha Noi',
                    'HCM City' => 'HCM City',
                    'Da Nang' => 'Da Nang',
                    'Can Tho' => 'Can Tho'
                ],
                'expanded' => true //false: drop-down
                                    //true: radio button
            ]) 
            ->add('phone', NumberType::class,
            [
                'label' => "Number Phone",
                'attr' => [
                    'maxlength' => 10,
                    'minlength' => 10
                ]
            ])
            ->add('email', TextType::class,
            [
                'label' => "Email",
                'attr' => [
                    'maxlength' => 50,
                    'minlength' => 10
                ]
            ])
            ->add('avatar')
            ->add('subjects', EntityType::class,
            [
                'class' => Subject::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false
                /* expanded: true => checkbox
                   expanded: false => dropdown */
            ])
            ->add('Submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Teacher::class,
        ]);
    }
}
