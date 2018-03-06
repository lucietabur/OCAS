<?php

namespace OCAS\OCASBundle\Controller;

use OCAS\OCASBundle\Entity\Agence;
use OCAS\OCASBundle\Form\AgenceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AgenceController extends Controller
{

  /**
   * @Route("/agences/{page}",name="agence_list",defaults={"page"=1})
   */
    public function listAction($page = 1)
    {
        $searchform = $this->createFormBuilder()
    ->add('Agence', TextType::class, array('attr' => array( 'class' => "")))
    ->add('rechercher', SubmitType::class, array('attr' => array('class' => 'btn btn-success') ))
    ->setMethod('POST')
    ->setAction($this->generateUrl('agence_search'))
    ->getForm();
        $repository = $this->getDoctrine()->getRepository('OCASBundle:Agence');
        $listeAgences = $repository->findAll();
        $agences = $this->get('knp_paginator')->paginate(
      $listeAgences,
      $page
    );

        if ($page < 1) {
            throw $this->createNotFoundException('Page '.$page.' inexistante.');
        }

        return $this->render('@OCAS/Agence/list_view.html.twig', array(
        'agences' => $agences,
        'form' => $searchform->createView(),
        'h1' => 'OCAS : Liste des résidences administratives'
    ));
    }
    /**
     * @Route("agence/add", name="agence_add")
     */
    public function addAction(Request $request)
    {
        $agence= new Agence();
        $form = $this->createForm(AgenceType::class, $agence);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($agence);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Résidence administrative bien enregistré•e.');
            return $this->redirectToRoute('agence_list');
        }
        return $this->render('@OCAS/Agence/form.html.twig', array(
        'h1' => "OCAS : Ajouter une résidence administrative",
        'form' => $form->createView(),
      ));
    }

    /**
     * @Route("/agence/{id}/edit/",name="agence_edit",defaults={"id"="1"},requirements={"id"="\d*"})
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $agence = $em->getRepository('OCASBundle:Agence')->find($id);

        if ($id == null) {
            $request->getSession()->getFlashBag()->add('notice', "La résidence administrative demandé n'a pas pu être trouvé");
            return $this->redirectToRoute('agence_list');
            //on rajoutera a l'affichage "agence demandé n'existe pas"
        }
        $form = $this->createForm(AgenceType::class, $agence);
        $form->handleRequest($request);

        // soumission du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($agence);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Résidence administrative bien modifié•e');
            return $this->redirectToRoute('agence_list');
        }

        return $this->render('@OCAS/Agence/form.html.twig', array(
        'agence' =>  $agence,
        'id' => $id,
        'h1' => "OCAS : Modifier un agence",
        'form' => $form->createView()
       ));
    }

    /**
     * @Route("/agence/delete/{id}/",name="agence_delete",defaults={"id"="1"},requirements={"id"="\d*"})
     */
    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $agence = $em->getRepository('OCASBundle:Agence')->find($id);

        if (null === $agence) {
            throw new NotFoundHttpException("La résidence administrative demandée n'existe pas");
        }
        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->remove($agence);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info', "La résidence administrative a bien été supprimée");

            return $this->redirectToRoute('agence_list');
        }
        return $this->render('@OCAS/Agence/delete.html.twig', array(
        'agence' => $agence,
        'form' => $form->createView()
      ));
    }

    /**
     * @Route("/agence/search",name="agence_search")
     */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager()->getRepository('OCASBundle:Agence');
        $req=$request->request->all()["form"]["Agence"];
        $agences = $em->findByName($req);
        $agences = $this->get('knp_paginator')->paginate(
        $agences,
        1
      );

        return $this->render('@OCAS/Agence/list_result.html.twig', array(
          'agences' =>  $agences,
          'h1' => 'OCAS : Résultat de la recherche'
         ));
    }
}
