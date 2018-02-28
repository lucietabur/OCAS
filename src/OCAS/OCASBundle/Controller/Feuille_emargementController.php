<?php

namespace OCAS\OCASBundle\Controller;

use OCAS\OCASBundle\Entity\Feuille_emargement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use OCAS\OCASBundle\Form\FeuilleType;
use OCAS\OCASBundle\Form\SearchType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Feuille_emargementController extends Controller
{
    /**
     * @Route("/feuilles/{page}",name="feuille_list",defaults={"page"=1})
     */
    public function listAction($page = 1)
    {
        $repository = $this->getDoctrine()->getRepository('OCASBundle:Feuille_emargement');
        $listeFeuilles = $repository->findAll();
        $feuilles = $this->get('knp_paginator')->paginate(
        $listeFeuilles,
        $page
      );

        if ($page < 1) {
            throw $this->createNotFoundException('Page '.$page.' inexistante.');
        }

        return $this->render('@OCAS/Feuille/list.html.twig', array(
          'feuilles' => $feuilles,
      ));
    }

    /**
     * @Route("feuille/add", name="feuille_add")
     */
    public function addAction(Request $request)
    {
        $feuille= new Feuille_emargement();
        $form = $this->createForm(FeuilleType::class, $feuille);

        $searchform = $this->createForm(SearchType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($feuille);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Feuille_emargement bien enregistré•e.');
            return $this->redirectToRoute('stagiaire_list');
        }
        return $this->render('@OCAS/Feuille/form.html.twig', array(
        'h1' => "Ajouter une feuille",
        'form' => $form->createView(),
        'searchform' => $searchform->createView()
      ));
    }

    /**
     * @Route("/feuille/{id}/edit/",name="feuille_edit",defaults={"id"="1"},requirements={"id"="\d*"})
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $feuille = $em->getRepository('OCASBundle:Feuille_emargement')->find($id);

        if ($id == null) {
            $request->getSession()->getFlashBag()->add('notice', "la feuille demandée n'a pas pu être trouvé");
            return $this->redirectToRoute('feuille_list');
            //on rajoutera a l'affichage "stagiaire demandé n'existe pas"
        }
        $form = $this->createForm(FeuilleType::class, $feuille);
        $form->handleRequest($request);

        // soumission du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($feuille);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Feuille bien modifiée');
            return $this->redirectToRoute('feuille_list');
        }

        return $this->render('@OCAS/Feuille/form.html.twig', array(
        'feuille' =>  $feuille,
        'id' => $id,
        'h1' => "Modifier une feuille",
        'form' => $form->createView()
       ));
    }

    /**
     * @Route("/feuille/delete/{id}/",name="feuille_delete",defaults={"id"="1"},requirements={"id"="\d*"})
     */
    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $feuille = $em->getRepository('OCASBundle:Feuille_emargement')->find($id);

        if (null === $feuille) {
            throw new NotFoundHttpException("La feuille demandée n'existe pas");
        }
        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->remove($feuille);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info', "La feuille a bien été supprimée");

            return $this->redirectToRoute('feuille_list');
        }
        return $this->render('@OCAS/Feuille/delete.html.twig', array(
        'feuille' => $feuille,
        'form' => $form->createView()
      ));
    }
}
