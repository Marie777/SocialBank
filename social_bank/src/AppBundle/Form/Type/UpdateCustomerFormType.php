<?php

namespace AppBundle\Form\Type;

use AppBundle\DBAL\MaritalStatus;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateCustomerFormType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class)
            ->add('email', EmailType::class)
            ->add('name', TextType::class)
            ->add('dateOfBirth', DateType::class)
            ->add('jobDescription', TextType::class)
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Married' => MaritalStatus::MARRIED,
                    'Single' => MaritalStatus::SINGLE,
                    'Divorced' => MaritalStatus::DIVORCED
                ]
            ])
            ->add('submit', SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Customer',
        ]);
    }
}