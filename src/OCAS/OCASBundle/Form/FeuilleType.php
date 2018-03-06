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

class FeuilleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('formation', EntityType::class, array(
          'class' => 'OCAS\OCASBundle\Entity\Formation',
          'choice_label' => 'libelle',
          'placeholder' => ''
        ))
          // ->add('formation', EntityType::class, array(
          //   'class' => 'OCAS\OCASBundle\Entity\Formation',
          //   'choice_label' => 'libelle_formation',
          //   'placeholder' => ''
          // ))
          ->add('intervenant', EntityType::class, array(
            'class' => 'OCAS\OCASBundle\Entity\Intervenant',
            'choice_label' => 'nom',
            'placeholder' => '',
          ))
          ->add('dateSeance', DateTimeType::class)
          ->add('groupe', TextType::class, array('required' => false))
          ->add('duree', IntegerType::class, array('required' => false ))
          ->add('dateRetour', DateTimeType::class)
          ->add('lieu', TextType::class, array('required' => false))
          ->add('observation', TextType::class, array('required' => false))
          ->add('enregistrer', SubmitType::class, array('attr' => array('class' => 'btn btn-success') ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OCAS\OCASBundle\Entity\Feuille_emargement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ocasbundle_feuille';
    }
}
