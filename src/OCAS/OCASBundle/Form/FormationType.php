<?php

namespace OCAS\OCASBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use OCAS\OCASBundle\Entity\Libelle_Formation;

class FormationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('libelle_formation', EntityType::class, array( //TODO: a corriger
          'class' => 'OCAS\OCASBundle\Entity\Libelle_Formation',
          'choice_label' => 'libelle',
        ))
        ->add('duree', IntegerType::class)
        ->add('dateDebut', DateTimeType::class)
        ->add('dateFin', DateTimeType::class)
        ->add('lieu', EntityType::class, array(
          'class' => 'OCAS\OCASBundle\Entity\Agence',
          'choice_label' => 'rsociale',
          'placeholder' => ''
        ))
        ->add('observation', TextType::class, array('required' => false))
        ->add('enregistrer', SubmitType::class, array('attr' => array('class' => 'btn btn-success') ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OCAS\OCASBundle\Entity\Formation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ocasbundle_intervenant';
    }
}
