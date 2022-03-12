<?php

namespace App\Form;

use App\Entity\Subject;
use App\Entity\Teacher;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SubjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('time', IntegerType::class,
            [
                'label' => "Time in each class",
                'attr' => [
                    'maxlength' => 10,
                    'minlength' => 60
                ]
            ])
            ->add('score', IntegerType::class,
            [
                'label' => "Score scale",
                'attr' => [
                    'maxlength' => 10,
                    'minlength' => 10
                ]
            ])
            ->add('cover')
            ->add('Submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Subject::class,
        ]);
    }
}
