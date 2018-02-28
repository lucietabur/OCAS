<?php

namespace OCAS\OCASBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use OCAS\OCASBundle\Entity\Formateur;
use OCAS\OCASBundle\Form\FormateurType;

class FormateurController extends Controller
{
    /**
     * @Route("/formateurs/{page}",name="formateur_list",defaults={"page"=1})
     */
    public function listAction($page = 1)
    {
        $searchform = $this->createFormBuilder()
      ->add('Formateur', TextType::class, array('attr' => array( 'class' => "")))
      ->add('rechercher', SubmitType::class, array('attr' => array('class' => 'btn btn-success') ))
      ->setMethod('POST')
      ->setAction($this->generateUrl('formateur_search'))
      ->getForm();
        $repository = $this->getDoctrine()->getRepository('OCASBundle:Formateur');
        $listeFormateurs = $repository->findAll();
        $formateurs = $this->get('knp_paginator')->paginate(
        $listeFormateurs,
        $page
      );

        if ($page < 1) {
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
    public function addAction(Request $request)
    {
        $formateur= new Formateur();
        $form = $this->createForm(FormateurType::class, $formateur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formateur);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Formateur bien enregistré•e.');
            return $this->redirectToRoute('formateur_list');
        }
        return $this->render('@OCAS/Formateur/form.html.twig', array(
        'h1' => "Ajouter un formateur",
        'form' => $form->createView(),
      ));
    }

    /**
     * @Route("/formateur/{id}/edit/",name="formateur_edit",defaults={"id"="1"},requirements={"id"="\d*"})
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $formateur = $em->getRepository('OCASBundle:Formateur')->find($id);

        if ($id == null) {
            $request->getSession()->getFlashBag()->add('notice', "Le formateur demandé n'a pas pu être trouvé");
            return $this->redirectToRoute('formateur_list');
            //on rajoutera a l'affichage "formateur demandé n'existe pas"
        }
        $form = $this->createForm(FormateurType::class, $formateur);
        $form->handleRequest($request);

        // soumission du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formateur);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Formateur bien modifié•e');
            return $this->redirectToRoute('formateur_list');
        }

        return $this->render('@OCAS/Formateur/form.html.twig', array(
        'formateur' =>  $formateur,
        'id' => $id,
        'h1' => "Modifier un formateur",
        'form' => $form->createView()
       ));
    }

    /**
     * @Route("/formateur/delete/{id}/",name="formateur_delete",defaults={"id"="1"},requirements={"id"="\d*"})
     */
    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $formateur = $em->getRepository('OCASBundle:Formateur')->find($id);

        if (null === $formateur) {
            throw new NotFoundHttpException("Le formateur demandée n'existe pas");
        }
        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->remove($formateur);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info', "Le formateur a bien été supprimée");

            return $this->redirectToRoute('formateur_list');
        }
        return $this->render('@OCAS/Formateur/delete.html.twig', array(
        'formateur' => $formateur,
        'form' => $form->createView()
      ));
    }

    /**
     * @Route("/formateur/search",name="formateur_search")
     */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager()->getRepository('OCASBundle:Formateur');
        $req=$request->request->all()["form"]["Formateur"];
        $formateurs = $em->FindBy(['nom' => $req]);
        $formateurs = $this->get('knp_paginator')->paginate(
        $formateurs,
        1
      );

        return $this->render('@OCAS/Formateur/list_result.html.twig', array(
          'formateurs' =>  $formateurs,
          'h1' => 'Résultat de la recherche'
         ));
    }
}
