<?php

namespace OCAS\OCASBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use OCAS\OCASBundle\Entity\Statut;

class SiegeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('rsociale', TextType::class, array('label' => 'Raison sociale'))
          ->add('correspondant', TextType::class, array('required' => false))
          ->add('numVoie', TextType::class, array('label' => 'numero de voie'))
          ->add('adresseComplement', TextType::class, array('required' => false))
          ->add('commune', TextType::class)
          ->add('codeDepartement', TextType::class, array('label' => 'Code postal'))
          ->add('telephone', TextType::class, array('required' => false))
          ->add('cedex', TextType::class, array('required' => false))
          ->add('enregistrer', SubmitType::class, array('attr' => array('class' => 'btn btn-success') ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OCAS\OCASBundle\Entity\Siege'
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
