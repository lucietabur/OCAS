<?php

namespace OCASBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use OCASBundle\Entity\Statut;

class StagiaireType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('nom', TextType::class)
          ->add('fonction',TextType::class, array('required' => false))
          ->add('ville',TextType::class, array('required' => false))
          ->add('naissance',BirthdayType::class, array('required' => false))
          ->add('titre',TextType::class, array('required' => false))
          ->add('nationalite',CountryType::class, array(
            'preferred_choices' => array('France' =>'FR'), //TODO : valeur les plus fréquentes
            'required' => false
          ))
          ->add('quotite',IntegerType::class, array('required' => false))
          ->add('statut',EntityType::class,array( //TODO: a corriger
            'class' => 'OCASBundle\Entity\Statut',
            'choice_label' => 'libelle',
            'required' => false
          ))
          ->add('enregistrer',SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OCASBundle\Entity\Stagiaire'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ocasbundle_stagiaire';
    }


}
