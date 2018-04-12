<?php

namespace OCAS\OCASBundle\Controller;

use OCAS\OCASBundle\Entity\Stagiaire;
use OCAS\OCASBundle\Form\StagiaireType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class StagiaireController extends Controller
{
    /**
     * @Route("/stagiaires/{page}",name="stagiaire_list",defaults={"page"=1})
     */
    public function listAction($page = 1)
    {
        $searchform = $this->createFormBuilder()
      ->add('Stagiaire', TextType::class, array('attr' => array( 'class' => "")))
      ->add('rechercher', SubmitType::class, array('attr' => array('class' => 'btn btn-success') ))
      ->setMethod('POST')
      ->setAction($this->generateUrl('stagiaire_search'))
      ->getForm();
        $repository = $this->getDoctrine()->getRepository('OCASBundle:Stagiaire');
        $listeStagiaires = $repository->findAll();
        $stagiaires = $this->get('knp_paginator')->paginate(
        $listeStagiaires,
        $page
      );

        if ($page < 1) {
            throw $this->createNotFoundException('Page '.$page.' inexistante.');
        }

        return $this->render('@OCAS/Stagiaire/list_view.html.twig', array(
          'stagiaires' => $stagiaires,
          'form' => $searchform->createView(),
          'h1' => 'OCAS : Liste des stagiaires',
      ));
    }

    /**
     * @Route("stagiaire/add", name="stagiaire_add")
     */
    public function addAction(Request $request)
    {
        $stagiaire= new Stagiaire();
        $form = $this->createForm(StagiaireType::class, $stagiaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($stagiaire);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Stagiaire bien enregistré•e.');
            return $this->redirectToRoute('stagiaire_list');
        }
        return $this->render('@OCAS/Stagiaire/form.html.twig', array(
          'h1' => "OCAS : Ajouter un stagiaire",
          'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/stagiaire/{id}/edit/",name="stagiaire_edit",defaults={"id"="1"},requirements={"id"="\d*"})
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $stagiaire = $em->getRepository('OCASBundle:Stagiaire')->find($id);

        if ($id == null) {
            $request->getSession()->getFlashBag()->add('notice', "Le stagiaire demandé n'a pas pu être trouvé");
            return $this->redirectToRoute('stagiaire_list');
            //on rajoutera a l'affichage "stagiaire demandé n'existe pas"
        }
        $form = $this->createForm(StagiaireType::class, $stagiaire);
        $form->handleRequest($request);

        // soumission du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($stagiaire);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Stagiaire bien modifié•e');
            return $this->redirectToRoute('stagiaire_list');
        }

        return $this->render('@OCAS/Stagiaire/form.html.twig', array(
          'stagiaire' =>  $stagiaire,
          'id' => $id,
          'h1' => "OCAS : Modifier un stagiaire",
          'form' => $form->createView()
         ));
    }

    /**
     * @Route("/stagiaire/delete/{id}/",name="stagiaire_delete",defaults={"id"="1"},requirements={"id"="\d*"})
     */
    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $stagiaire = $em->getRepository('OCASBundle:Stagiaire')->find($id);

        if (null === $stagiaire) {
            throw new NotFoundHttpException("Le stagiaire demandée n'existe pas");
        }
        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->remove($stagiaire);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info', "Le stagiaire a bien été supprimée");

            return $this->redirectToRoute('stagiaire_list');
        }
        return $this->render('@OCAS/Stagiaire/delete.html.twig', array(
          'stagiaire' => $stagiaire,
          'form' => $form->createView()
        ));
    }

    /**
     * @Route("/stagiaire/search",name="stagiaire_search")
     */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager()->getRepository('OCASBundle:Stagiaire');
        $req=$request->request->all()["form"]["Stagiaire"];
        $stagiaires = $em->findByName($req);
        $stagiaires = $this->get('knp_paginator')->paginate(
        $stagiaires,
        1
      );

        return $this->render('@OCAS/Stagiaire/list_result.html.twig', array(
          'stagiaires' =>  $stagiaires,
          'h1' => 'OCAS : Résultat de la recherche',
         ));
    }

    /**
     * @Route("/stagiaire/{id}/generate/mission",name="stagiaire_mission",defaults={"id"="1"},requirements={"id"="\d*"})
     */
    public function generateMission($id,Request $request)
    {
      $defaultData = array();
      $form = $this->createFormBuilder($defaultData)
        ->add('send', SubmitType::class)
        ->getForm();
      $form->handleRequest($request);
      $em = $this->getDoctrine()->getManager();
      $stagiaire = $em->getRepository('OCASBundle:Stagiaire')->find($id);
      //rechercher la formation


      return $this->render('@OCAS/PDF/ordre_de_mission.html.twig', array(
        'stagiaire' =>  $stagiaire,
        'h1' => "OCAS : Génerer l'odre de mission"
       ));
    }
}
