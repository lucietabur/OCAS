<?php

namespace OCAS\OCASBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SessionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('libelle_formation', EntityType::class, array(
            'class' => 'OCAS\OCASBundle\Entity\Libelle_Formation',
            'choice_label' => 'libelle',
            'placeholder' => ''
          ))
          ->add('intervenants', EntityType::class, array(
            'class' => 'OCAS\OCASBundle\Entity\Intervenant',
            'choice_label' => 'nom',
            'multiple' => true,
            'placeholder' => '',
          ))
          ->add('dateDebut', DateTimeType::class)
          ->add('dateFin', DateTimeType::class)
          ->add('groupe', IntegerType::class, array(
            'required' => false))
          ->add('duree', TimeType::class, array(
            'required' => false,
            'minutes' => array('0','15','30','45')
          ))
          ->add('dateRetour', DateTimeType::class)
          ->add('observation', TextType::class, array('required' => false))
          ->add('enregistrer', SubmitType::class, array('attr' => array('class' => 'btn btn-success') ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OCAS\OCASBundle\Entity\Session'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ocasbundle_session';
    }
}
