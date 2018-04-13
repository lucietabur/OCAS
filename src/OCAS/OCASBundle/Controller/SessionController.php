<?php

namespace OCAS\OCASBundle\Controller;

use OCAS\OCASBundle\Entity\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use OCAS\OCASBundle\Form\SessionType;
use OCAS\OCASBundle\Form\SearchType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SessionController extends Controller
{
    /**
     * @Route("/sessions/{page}",name="session_list",defaults={"page"=1})
     */
    public function listAction($page = 1)
    {
        $repository = $this->getDoctrine()->getRepository('OCASBundle:Session');
        $listeSessions = $repository->findAll();
        $sessions = $this->get('knp_paginator')->paginate(
        $listeSessions,
        $page
      );

        if ($page < 1) {
            throw $this->createNotFoundException('Page '.$page.' inexistante.');
        }

        return $this->render('@OCAS/Session/list.html.twig', array(
          'sessions' => $sessions,
          'h1' => 'Liste des sessions'
      ));
    }

    /**
     * @Route("session/add", name="session_add")
     */
    public function addAction(Request $request)
    {
        $session= new Session();
        $form = $this->createForm(SessionType::class, $session);

        $searchform = $this->createForm(SearchType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($session);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Session bien enregistré•e.');
            return $this->redirectToRoute('session_list');
        }
        return $this->render('@OCAS/Session/form.html.twig', array(
        'h1' => "OCAS : Ajouter une session",
        'form' => $form->createView(),
        'searchform' => $searchform->createView()
      ));
    }

    /**
     * @Route("/session/{id}/edit/",name="session_edit",defaults={"id"="1"},requirements={"id"="\d*"})
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $em->getRepository('OCASBundle:Session')->find($id);

        if ($id == null) {
            $request->getSession()->getFlashBag()->add('notice', "la session demandée n'a pas pu être trouvé");
            return $this->redirectToRoute('session_list');
            //on rajoutera a l'affichage "stagiaire demandé n'existe pas"
        }
        $form = $this->createForm(SessionType::class, $session);
        $form->handleRequest($request);

        // soumission du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($session);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Session bien modifiée');
            return $this->redirectToRoute('session_list');
        }

        return $this->render('@OCAS/Session/form.html.twig', array(
        'session' =>  $session,
        'id' => $id,
        'h1' => "OCAS : Modifier une session",
        'form' => $form->createView()
       ));
    }

    /**
     * @Route("/session/delete/{id}/",name="session_delete",defaults={"id"="1"},requirements={"id"="\d*"})
     */
    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $session = $em->getRepository('OCASBundle:Session')->find($id);

        if (null === $session) {
            throw new NotFoundHttpException("La session demandée n'existe pas");
        }
        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->remove($session);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info', "La session a bien été supprimée");

            return $this->redirectToRoute('session_list');
        }
        return $this->render('@OCAS/Session/delete.html.twig', array(
        'session' => $session,
        'form' => $form->createView()
      ));
    }

    /**
     * @Route("/session/{id}/generate/mission",name="session_mission",defaults={"id"="1"},requirements={"id"="\d*"})
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
