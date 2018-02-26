<?php

namespace OCAS\OCASBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class FormateurController extends Controller
{
    /**
     * @Route("/formateurs/{page}",name="formateur_list",defaults={"page"=1})
     */
    public function listAction($page = 1)
    {
      $searchform = $this->createFormBuilder()
      ->add('Formateur',TextType::class, array('attr' => array( 'class' => "")))
      ->add('rechercher',SubmitType::class, array('attr' => array('class' => 'btn btn-success') ))
      ->setMethod('POST')
      ->setAction($this->generateUrl('formateur_search'))
      ->getForm();
      $repository = $this->getDoctrine()->getRepository('OCASBundle:Formateur');
      $listeFormateurs = $repository->findAll();
      $formateurs = $this->get('knp_paginator')->paginate(
        $listeFormateurs,
        $page);

      if ($page < 1){
        throw $this->createNotFoundException('Page '.$page.' inexistante.');
      }

      return $this->render('@OCAS/Formateur/list_view.html.twig', array(
          'formateurs' => $formateurs,
          'form' => $searchform->createView(),
          'h1' => 'Liste des formateurs'
      ));
    }

    /**
     * @Route("/formateur/add", name="formateur_add")
     */
    public function addAction()
    {
        return $this->render('OCASBundle:Formateur:form.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/formateur/{id}/edit/",name="formateur_edit",defaults={"id"="1"},requirements={"id"="\d*"})
     */
    public function editAction()
    {
        return $this->render('OCASBundle:Formateur:form.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/formateur/delete/{id}/",name="formateur_delete",defaults={"id"="1"},requirements={"id"="\d*"})
     */
    public function deleteAction()
    {
        return $this->render('OCASBundle:Formateur:delete.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/formateur/search",name="formateur_search")
     */
    public function searchAction(Request $request)
    {
      return $this->render('@OCAS/Formateur/list_result.html.twig', array(
        //'stagiaires' =>  $stagiaires,
        'h1' => 'Résultat de la recherche'
       ));
    }
}
