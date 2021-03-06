<?php

namespace OCAS\OCASBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use OCAS\OCASBundle\Entity\Statut;

class StagiaireType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      // $builder->addEventSubscriber(new AddSessionFieldSubscriber($propertyPath));


        $builder
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
            'required' => false)
          )
          ->add(
              'secteur',
              ChoiceType::class,
              array(
                'choices' => array(
                  'Qualification' => 'Qualification',
                  'Formation générale / illétrisme' => 'Formation générale / illétrisme',
                  'Insertion / Orientation' => 'Insertion / Orientation',
            ),
            'multiple' => true,
            'expanded' => true,
            'by_reference' => false,
            'required' => false)
          )
          ->add('ville', TextType::class, array('required' => false))
          ->add('naissance', BirthdayType::class, array(
            'required' => false,
            'years' => range(1940, date('Y')),
            'placeholder' => array(
              'year' => 'année', 'month' => 'mois', 'day' => 'jour'
            )
          ))
          ->add('titre', TextType::class, array('required' => false))
          ->add('nationalite', CountryType::class, array(
            'preferred_choices' => array('FR'),
            'required' => false,
            'data' => 1,
            'choices_as_values' => true
          ))
          ->add('quotite', IntegerType::class, array('required' => false))
          ->add('statut', EntityType::class, array(
            'class' => 'OCAS\OCASBundle\Entity\Statut',
            'choice_label' => 'libelle',
            'placeholder' => '',
            'required' => false
          ))
          ->add('agence', EntityType::class, array(
            'class' => 'OCAS\OCASBundle\Entity\Agence',
            'choice_label' => 'rsociale',
            'label' => 'Résidence administrative',
            'placeholder' => '',

          ))
          ->add('detail_session', CollectionType::class, array(
            'label' => 'Formations',
            'entry_type' => DetailType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false,
            'mapped' => true,
          ))
          ->add('enregistrer', SubmitType::class, array('attr' => array('class' => 'btn btn-success') ))
          ->add('enregistrer&suivant',SubmitType::class, array('attr' => array('class' => 'btn btn-success', 'label' => 'Enregistrer et ajouter un autre stagiaire') ));



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
