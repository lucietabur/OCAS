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
          ->add('stagiaire', HiddenType::class, array(
            'data' => '1' //TODO: recuperer la valeur
          ))
          ->add('formation', EntityType::class, array(
            'class' => 'OCAS\OCASBundle\Entity\Formation',
            'choice_label' => 'libelle',
            'placeholder' => ''
          ))
          ->add('typeFormation', TextType::class) //TODO: remplacer par case a cocher et changer en base
          ->add('h_present', IntegerType::class)
          ->add('h_absent', IntegerType::class)
          ->add('h_facture', IntegerType::class);
          // ->add('enregistrer', SubmitType::class, array('attr' => array('class' => 'btn btn-success') ))
          // ->add('enregistrer&suivant', SubmitType::class, array('attr' => array('class' => 'btn btn-success', 'label' => 'Enregistrer et ajouter un autre stagiaire') ));
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
        return 'ocasbundle_session';
    }
}