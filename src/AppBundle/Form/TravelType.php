<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TravelType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('city1', EntityType::class, array(
                'class' => 'AppBundle:City',
                'choice_label' => 'name',
                'placeholder' => 'Choose a city',
                'attr' => array(
                    'class' => 'form-control'
                ),
                //'label'  => false
            ))
            ->add('city2', EntityType::class, array(
                'class' => 'AppBundle:City',
                'choice_label' => 'name',
                'placeholder' => 'Choose a city',
                'attr' => array(
                    'class' => 'form-control'
                ),
                //'label'  => false
            ))
            ->add('cost', null, array(
                'attr' => array(
                    'placeholder' => 'Cost',
                    'class' => 'form-control'
                ),
                'label'  => false
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Travel'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_travel';
    }


}
