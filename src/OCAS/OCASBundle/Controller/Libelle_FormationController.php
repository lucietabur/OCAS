<?php

namespace OCAS\OCASBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use OCAS\OCASBundle\Entity\Libelle_Formation;
use OCAS\OCASBundle\Form\FormationType;

class Libelle_FormationController extends Controller
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
        $repository = $this->getDoctrine()->getRepository('OCASBundle:Libelle_Formation');
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
          'h1' => 'OCAS : Liste des formations'
      ));
    }
    /**
     * @Route("formation/add", name="formation_add")
     */
    public function addAction(Request $request)
    {
        $formation= new Libelle_Formation();
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formation);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Libellé de formation bien enregistré');
            return $this->redirectToRoute('formation_list');
        }
        return $this->render('@OCAS/Formation/form.html.twig', array(
        'h1' => "OCAS : Ajouter un libellé de formation",
        'form' => $form->createView(),
      ));
    }

    /**
     * @Route("/formation/search",name="formation_search")
     */
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager()->getRepository('OCASBundle:Libelle_Formation');
        $req=$request->request->all()["form"]["Formation"];
        $formations = $em->findByName($req);
        $formations = $this->get('knp_paginator')->paginate(
        $formations,
        1
      );

        return $this->render('@OCAS/Formation/list_result.html.twig', array(
          'formations' =>  $formations,
          'h1' => 'OCAS : Résultat de la recherche'
         ));
    }
}
