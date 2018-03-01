<?php

namespace OCAS\OCASBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use OCAS\OCASBundle\Entity\Intervenant;
use OCAS\OCASBundle\Form\IntervenantType;

class IntervenantController extends Controller
{
    /**
     * @Route("/intervenants/{page}",name="intervenant_list",defaults={"page"=1})
     */
    public function listAction($page = 1)
    {
        $searchform = $this->createFormBuilder()
      ->add('Intervenant', TextType::class, array('attr' => array( 'class' => "")))
      ->add('rechercher', SubmitType::class, array('attr' => array('class' => 'btn btn-success') ))
      ->setMethod('POST')
      ->setAction($this->generateUrl('intervenant_search'))
      ->getForm();
        $repository = $this->getDoctrine()->getRepository('OCASBundle:Intervenant');
        $listeIntervenants = $repository->findAll();
        $intervenants = $this->get('knp_paginator')->paginate(
        $listeIntervenants,
        $page
      );

        if ($page < 1) {
            throw $this->createNotFoundException('Page '.$page.' inexistante.');
        }

        return $this->render('@OCAS/Intervenant/list_view.html.twig', array(
          'intervenants' => $intervenants,
          'form' => $searchform->createView(),
          'h1' => 'OCAS : Liste des intervenants'
      ));
    }

    /**
     * @Route("/intervenant/add", name="intervenant_add")
     */
    public function addAction(Request $request)
    {
        $intervenant= new Intervenant();
        $form = $this->createForm(IntervenantType::class, $intervenant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($intervenant);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Intervenant bien enregistré•e.');
            return $this->redirectToRoute('intervenant_list');
        }
        return $this->render('@OCAS/Intervenant/form.html.twig', array(
        'h1' => "OCAS : Ajouter un intervenant",
        'form' => $form->createView(),
      ));
    }

    /**
     * @Route("/intervenant/{id}/edit/",name="intervenant_edit",defaults={"id"="1"},requirements={"id"="\d*"})
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $intervenant = $em->getRepository('OCASBundle:Intervenant')->find($id);

        if ($id == null) {
            $request->getSession()->getFlashBag()->add('notice', "Le intervenant demandé n'a pas pu être trouvé");
            return $this->redirectToRoute('intervenant_list');
            //on rajoutera a l'affichage "intervenant demandé n'existe pas"
        }
        $form = $this->createForm(IntervenantType::class, $intervenant);
        $form->handleRequest($request);

        // soumission du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($intervenant);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Intervenant bien modifié•e');
            return $this->redirectToRoute('intervenant_list');
        }

        return $this->render('@OCAS/Intervenant/form.html.twig', array(
        'intervenant' =>  $intervenant,
        'id' => $id,
        'h1' => "OCAS : Modifier un intervenant",
        'form' => $form->createView()
       ));
    }

    /**
     * @Route("/intervenant/delete/{id}/",name="intervenant_delete",defaults={"id"="1"},requirements={"id"="\d*"})
     */
    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $intervenant = $em->getRepository('OCASBundle:Intervenant')->find($id);

        if (null === $intervenant) {
            throw new NotFoundHttpException("Le intervenant demandée n'existe pas");
        }
        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->remove($intervenant);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info', "Le intervenant a bien été supprimée");

            return $this->redirectToRoute('intervenant_list');
        }
        return $this->render('@OCAS/Intervenant/delete.html.twig', array(
        'intervenant' => $intervenant,
        'form' => $form->createView()
      ));
    }

    /**
     * @Route("/intervenant/search",name="intervenant_search")
     */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager()->getRepository('OCASBundle:Intervenant');
        $req=$request->request->all()["form"]["Intervenant"];
        $intervenants = $em->findByName($req);
        $intervenants = $this->get('knp_paginator')->paginate(
        $intervenants,
        1
      );

        return $this->render('@OCAS/Intervenant/list_result.html.twig', array(
          'intervenants' =>  $intervenants,
          'h1' => 'OCAS : Résultat de la recherche'
         ));
    }
}
