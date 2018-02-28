<?php

namespace OCAS\OCASBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use OCAS\OCASBundle\Entity\Formation;
use OCAS\OCASBundle\Form\FormationType;

class FormationController extends Controller
{
    /**
     * @Route("/formations/{page}",name="formation_list",defaults={"page"=1})
     */
    public function listAction($page = 1)
    {
        $searchform = $this->createFormBuilder()
      ->add('Formation', TextType::class, array('attr' => array( 'class' => "")))
      ->add('rechercher', SubmitType::class, array('attr' => array('class' => 'btn btn-success') ))
      ->setMethod('POST')
      ->setAction($this->generateUrl('formation_search'))
      ->getForm();
        $repository = $this->getDoctrine()->getRepository('OCASBundle:Formation');
        $listeFormations = $repository->findAll();
        $formations = $this->get('knp_paginator')->paginate(
        $listeFormations,
        $page
      );

        if ($page < 1) {
            throw $this->createNotFoundException('Page '.$page.' inexistante.');
        }

        return $this->render('@OCAS/Formation/list_view.html.twig', array(
          'formations' => $formations,
          'form' => $searchform->createView(),
          'h1' => 'Liste des formations'
      ));
    }

    /**
     * @Route("/formation/add", name="formation_add")
     */
    public function addAction(Request $request)
    {
        $formation= new Formation();
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formation);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Formation bien enregistré•e.');
            return $this->redirectToRoute('formation_list');
        }
        return $this->render('@OCAS/Formation/form.html.twig', array(
        'h1' => "Ajouter une formation",
        'form' => $form->createView(),
      ));
    }

    /**
     * @Route("/formation/{id}/edit/",name="formation_edit",defaults={"id"="1"},requirements={"id"="\d*"})
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $formation = $em->getRepository('OCASBundle:Formation')->find($id);

        if ($id == null) {
            $request->getSession()->getFlashBag()->add('notice', "Le formation demandé n'a pas pu être trouvé");
            return $this->redirectToRoute('formation_list');
            //on rajoutera a l'affichage "formation demandé n'existe pas"
        }
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        // soumission du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formation);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Formation bien modifié•e');
            return $this->redirectToRoute('formation_list');
        }

        return $this->render('@OCAS/Formation/form.html.twig', array(
        'formation' =>  $formation,
        'id' => $id,
        'h1' => "Modifier une formation",
        'form' => $form->createView()
       ));
    }

    /**
     * @Route("/formation/delete/{id}/",name="formation_delete",defaults={"id"="1"},requirements={"id"="\d*"})
     */
    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $formation = $em->getRepository('OCASBundle:Formation')->find($id);

        if (null === $formation) {
            throw new NotFoundHttpException("Le formation demandée n'existe pas");
        }
        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->remove($formation);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info', "Le formation a bien été supprimée");

            return $this->redirectToRoute('formation_list');
        }
        return $this->render('@OCAS/Formation/delete.html.twig', array(
        'formation' => $formation,
        'form' => $form->createView()
      ));
    }

    /**
     * @Route("/formation/search",name="formation_search")
     */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager()->getRepository('OCASBundle:Formation');
        $req=$request->request->all()["form"]["Formation"];
        $formations = $em->FindBy(['libelle' => $req]);
        $formations = $this->get('knp_paginator')->paginate(
        $formations,
        1
      );

        return $this->render('@OCAS/Formation/list_result.html.twig', array(
          'formations' =>  $formations,
          'h1' => 'Résultat de la recherche'
         ));
    }
}
