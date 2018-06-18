<?php

namespace OCAS\OCASBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DetailEditType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

          ->add('session', EntityType::class, array(
            'class' => 'OCAS\OCASBundle\Entity\Session',
            'choice_label' => 'libelle_formation.libelle',
            'placeholder' => ''
          ))
          ->add(
              'typeFormation',
              ChoiceType::class,
              array(
                'choices' => array(
                  'Qualification' => 'Qualification',
                  'Formation générale / illétrisme' => 'Formation générale / illétrisme',
                  'Insertion / Orientation' => 'Insertion / Orientation',
            ),
            'multiple' => true,
            'expanded' => true,
            'required' => false)
          )
          ->add('h_present', IntegerType::class)
          ->add('h_absent', IntegerType::class)
          ->add('h_facture', IntegerType::class)
          ->add('enregistrer', SubmitType::class, array('attr' => array('class' => 'btn btn-success') ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OCAS\OCASBundle\Entity\Detail_session'
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
