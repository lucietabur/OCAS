<?php

namespace OCAS\OCASBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use OCAS\OCASBundle\Entity\Statut;

class StagiaireMissionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('titre', TextType::class)
          ->add('nom', TextType::class)
          ->add(
              'fonction',
              ChoiceType::class,
              array(
            'choices' => array(
              'Formateur·ice' => 'Formateur·ice',
              'Psychologue' => 'Psychologue',
              'Conseiller·e en formation continue' => 'Conseiller·e en formation continue',
              'Assistant·e administratif·ve' => 'Assistant·e administratif·ve',
              'Responsable des affaires administratives et financières' => 'Responsable des affaires administratives et financières',
              'Directeur·ice des études' => 'Directeur·ice des études',
              'Coordinateur·ice' => 'Coordinateur·ice',
              'Vacataire' => 'Vacataire',
              'Animateur·ice en formation continue' => 'Animateur·ice en formation continue'
            ),
            'multiple' => true,
            'disabled' => 'true')
          )
          ->add('agence', EntityType::class, array(
            'class' => 'OCAS\OCASBundle\Entity\Agence',
            'choice_label' => 'rsociale',
            'label' => 'Résidence administrative',
            'placeholder' => '',
            'disabled' => 'true'
          ))
          ->add('transport', ChoiceType::class,array(
            'expanded' => true,
            'choices' => array(
              'transport en commun (joindre le titre de transport)' => 0,
              'véhicule personnel sur autorisation du Directeur du GIP-FCIP' => 1
            ),
             'mapped' => false
          ))
          ->add('remboursement', ChoiceType::class, array(
            'choices' => array(
              'SANS REMBOURSEMENT' => 'SANS REMBOURSEMENT',
              'selon tarif SNCF 2ème classe' => 'selon tarif SNCF 2ème classe'
            ),
            'mapped' => false
          ))
          ->add('restauration', ChoiceType::class, array(
            'choices' => array(
              'pris en charge par le GIP' => 0,
              'à rembourser par le GIP' => 1,
              'sans remboursement' => 2
            ),
            'expanded' => true,
            'mapped' => false
          ));
          // ->add('siege', EntityType::class, array(
          //   'class' => 'OCAS\OCASBundle\Entity\Siege',
          //   'choice_label' => 'rsociale',
          //   'label' => 'Siege',
          //   'placeholder' => '',
          //   'disabled' => 'true'
          // ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OCAS\OCASBundle\Entity\Stagiaire'
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
