<?php

namespace OCAS\OCASBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
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
        ->add('libelle', EntityType::class, array(
          'class' => 'OCAS\OCASBundle\Entity\Libelle_Formation',
          'choice_label' => 'libelle',
          'placeholder' => '',
          'mapped' => false,
          'label_attr' => array( 'class' => 'select_libelle'),
        ))
        ->add('session', EntityType::class, array( //TODO: discriminer les sessions
          'class' => 'OCAS\OCASBundle\Entity\Session',
          'mapped' => true,
          'choice_label' => 'libelle_formation.libelle',
          // 'choice_label' => function($session){
          //   return $session->getLibelleFormation()->getLibelle().' - '.$session->getDateDebut();
          //   },
          // 'placeholder' => '',
          'attr' => array( 'class' => 'select_session'),


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


        $builder->addEventListener(FormEvents::PRE_SUBMIT, function(FormEvent $event) {
            $data = $event->getData();

            // if ($libelle!=null){
            //   $builder->add('session', EntityType::class, array( //TODO: discriminer les sessions
            //     'class' => 'OCAS\OCASBundle\Entity\Session',
            //     'choice_label' => 'libelle_formation.libelle',
            //     'placeholder' => '',
            //   ));
            //
            // }

        });
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
