<?php

namespace OCAS\OCASBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use OCAS\OCASBundle\Form\RepeteMissionType;

class MissionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('libelle', TextType::class, array('disabled' => 'true'))
          ->add('lieu')
          ->add('date_formation', DateTimeType::class)
          ->add('imputation', TextType::class)
          ->add('suivi_par')
          ->add('ref')
          ->add('date_edition', DateTimeType::class)

          ->add('stagiaires', CollectionType::class, array(
            'entry_type' => StagiaireMissionType::class,
            'allow_add' => false,
            'allow_delete' => false,
            'by_reference' => false,

          ))
          ->add('enregistrer', SubmitType::class, array('attr' => array('class' => 'btn btn-success') ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {

    }
}
