<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;


class CommentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        $sides = [ $options['data']->getDebateId()->getSide1() => '1', $options['data']->getDebateId()->getSide2() => '2'];
        $builder
            ->add('content', TextareaType::class, array('attr' => array('class' => 'form-check')))
            ->add('agree', ChoiceType::class, array(
                'attr' => array('class' => 'form-radio-input'),
                'choices' => $sides,
                'expanded' => 'true'
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
            'data_class' => Comment::class,
        ]);
    }
}
