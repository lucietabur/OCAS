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
        //TODO: num_emargement auto increment
          ->add('formation', EntityType::class, array(
            'class' => 'OCAS\OCASBundle\Entity\Formation',
            'choice_label' => 'libelle',
            'placeholder' => ''
          ))
          // ->add('libelle_formation', EntityType::class, array( //TODO: a corriger
          //   'class' => 'OCAS\OCASBundle\Entity\Libelle_Formation',
          //   'choice_label' => 'libelle',
          // ))
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
            'data_class' => 'OCAS\OCASBundle\Entity\Detail_formation'
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
