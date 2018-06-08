<?php
namespace OCAS\OCASBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Doctrine\ORM\EntityRepository;
use OCAS\OCASBundle\Entity\Stagiaire;

class AddSessionFieldSubscriber implements EventSubscriberInterface
{
    private $propertyPath;

    public function __construct($propertyPath)
    {
        $this->propertyPath = $propertyPath;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA  => 'preSetData',
            FormEvents::PRE_SUBMIT    => 'preSubmit'
        );
    }

    private function setSession($form, $session_id)
    {
        $formOptions = array(
          'class' => 'OCAS\OCASBundle\Entity\Session',
          'choice_label' => 'libelle_formation.libelle',
          'query_builder' => function (EntityRepository $repository) use ($session_id) {
              $qb = $repository->createQueryBuilder('session')
                  ->where('session.id = :session')
                  ->setParameter('session', $session_id)
              ;

              return $qb;
            }
            );
            
        $form->add($this->propertyPath, 'entity', $formOptions);
    }

    // public function preSetData(FormEvent $event)
    // {
    //     $data = $event->getData();
    //     $form = $event->getForm();
    //
    //     if (null === $data) {
    //         return;
    //     }
    //
    //     $accessor    = PropertyAccess::createPropertyAccessor();
    //
    //     $city        = $accessor->getValue($data, $this->propertyPath);
    //     $province_id = ($city) ? $city->getProvince()->getId() : null;
    //
    //     $this->addCityForm($form, $province_id);
    // }

    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
        return;
        }
         $session_id = array_key_exists('session', $data['detail_session']) ? $data['detail_session']['session'] : null;
         $this->setSession($form,$session_id);
      });
}
