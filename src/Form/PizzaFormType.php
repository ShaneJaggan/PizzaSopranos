<?php

namespace App\Form;

use App\Entity\Size;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class PizzaFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fname', TextType::class , ['label' => 'Firstname'])
            ->add('sname', TextType::class , ['label' => 'Lastname'])
            ->add('city', TextType::class , ['label' => 'City'])
            ->add('adress', TextType::class , ['label' => 'Adress'])
            ->add('zipcode', TextType::class , ['label' => 'Zipcode'])
            ->add('size_id',
                ChoiceType::class,
                [
                    'choices' => [
                        'medium pizza (25 cm)' => 1,
                        'large pizza (35 cm)' => 2,
                        'calzone' => 3,
                    ]
                ])
        ;
    }

}