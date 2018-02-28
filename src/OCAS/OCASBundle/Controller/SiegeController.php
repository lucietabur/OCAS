<?php

namespace OCAS\OCASBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SiegeController extends Controller
{

  /**
   * @Route("/sieges/{page}",name="siege_list",defaults={"page"=1})
   */
  public function listAction($page = 1)
  {
      $searchform = $this->createFormBuilder()
    ->add('Siege', TextType::class, array('attr' => array( 'class' => "")))
    ->add('rechercher', SubmitType::class, array('attr' => array('class' => 'btn btn-success') ))
    ->setMethod('POST')
    ->setAction($this->generateUrl('siege_search'))
    ->getForm();
      $repository = $this->getDoctrine()->getRepository('OCASBundle:Siege');
      $listeSieges = $repository->findAll();
      $sieges = $this->get('knp_paginator')->paginate(
      $listeSieges,
      $page
    );

      if ($page < 1) {
          throw $this->createNotFoundException('Page '.$page.' inexistante.');
      }

      return $this->render('@OCAS/Siege/list_view.html.twig', array(
        'sieges' => $sieges,
        'form' => $searchform->createView(),
        'h1' => 'OCAS : Liste des sieges'
    ));
  }
  /**
   * @Route("siege/add", name="siege_add")
   */
  public function addAction(Request $request)
  {
      $siege= new Siege();
      $form = $this->createForm(SiegeType::class, $siege);
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->persist($siege);
          $em->flush();

          $request->getSession()->getFlashBag()->add('notice', 'Siege bien enregistré•e.');
          return $this->redirectToRoute('siege_list');
      }
      return $this->render('@OCAS/Siege/form.html.twig', array(
        'h1' => "OCAS : Ajouter un siege",
        'form' => $form->createView(),
      ));
  }

  /**
   * @Route("/siege/{id}/edit/",name="siege_edit",defaults={"id"="1"},requirements={"id"="\d*"})
   */
  public function editAction($id, Request $request)
  {
      $em = $this->getDoctrine()->getManager();
      $siege = $em->getRepository('OCASBundle:Siege')->find($id);

      if ($id == null) {
          $request->getSession()->getFlashBag()->add('notice', "Le siege demandé n'a pas pu être trouvé");
          return $this->redirectToRoute('siege_list');
          //on rajoutera a l'affichage "siege demandé n'existe pas"
      }
      $form = $this->createForm(SiegeType::class, $siege);
      $form->handleRequest($request);

      // soumission du formulaire
      if ($form->isSubmitted() && $form->isValid()) {
          $em = $this->getDoctrine()->getManager();
          $em->persist($siege);
          $em->flush();
          $request->getSession()->getFlashBag()->add('notice', 'Siege bien modifié•e');
          return $this->redirectToRoute('siege_list');
      }

      return $this->render('@OCAS/Siege/form.html.twig', array(
        'siege' =>  $siege,
        'id' => $id,
        'h1' => "OCAS : Modifier un siege",
        'form' => $form->createView()
       ));
  }

  /**
   * @Route("/siege/delete/{id}/",name="siege_delete",defaults={"id"="1"},requirements={"id"="\d*"})
   */
  public function deleteAction($id, Request $request)
  {
      $em = $this->getDoctrine()->getManager();
      $siege = $em->getRepository('OCASBundle:Siege')->find($id);

      if (null === $siege) {
          throw new NotFoundHttpException("Le siege demandée n'existe pas");
      }
      $form = $this->get('form.factory')->create();

      if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
          $em->remove($siege);
          $em->flush();

          $request->getSession()->getFlashBag()->add('info', "Le siege a bien été supprimée");

          return $this->redirectToRoute('siege_list');
      }
      return $this->render('@OCAS/Siege/delete.html.twig', array(
        'siege' => $siege,
        'form' => $form->createView()
      ));
  }

    /**
     * @Route("/siege/search",name="siege_search")
     */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager()->getRepository('OCASBundle:Siege');
        $req=$request->request->all()["form"]["Siege"];
        $sieges = $em->findByName($req);
        $sieges = $this->get('knp_paginator')->paginate(
        $sieges,
        1
      );

        return $this->render('@OCAS/Siege/list_result.html.twig', array(
          'sieges' =>  $sieges,
          'h1' => 'OCAS : Résultat de la recherche'
         ));
    }
}
