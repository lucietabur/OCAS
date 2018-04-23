<?php

namespace OCAS\OCASBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DetailType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        //TODO: num auto increment
          ->add('session', EntityType::class, array( //TODO: discriminer les sessions
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
          );
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
