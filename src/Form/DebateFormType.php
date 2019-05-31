<?php

namespace App\Form;

use App\Entity\Debate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class DebateFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $categories = ['Alimentation' => 'food', 'Science' => 'science', 'Sport' => 'sport', 'TV réalité' => 'tv', 'Style' => 'style', 'Voyage' => 'travel', 'Médecine' => 'medecine'];
        
        $builder
            ->add('title', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('description', TextareaType::class, array('attr' => array('class' => 'form-control','rows' => 6 )))
            ->add('Side1', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('Side2', TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('Category', ChoiceType::class, array(
                'attr' => array('class' => 'dropdownr'),
                'placeholder' => 'Choose a category',
                'choices' => $categories
                ))
            ->add('save', SubmitType::class, array(
                'label'=> 'Create',
                'attr' => array('class' => 'btn btn-primary')
            ))
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Debate::class,
        ]);
    }
}
