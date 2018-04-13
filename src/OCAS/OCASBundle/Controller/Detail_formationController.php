<?php

namespace OCAS\OCASBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use OCAS\OCASBundle\Entity\Detail_formation;
use OCAS\OCASBundle\Form\DetailType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Detail_formationController extends Controller
{

  /**
   * @Route("/session/{session_id}/stagiaires/{page}",name="detail_list",requirements={"session_id"="\d*"},defaults={"page"=1})
   */
    public function listAction($session_id, $page = 1)
    {
        //on recherche la session correspondant a l'id
        $em = $this->getDoctrine()->getManager();
        $session = $em->getRepository('OCASBundle:Session')->find($session_id);
        // on recherche tous les detail correspondant à la session d'émargement
        $repository = $this->getDoctrine()->getRepository('OCASBundle:Detail_formation');
        $listeDetails = $repository->findby(
      array("session" => $session)
    );

        $details = $this->get('knp_paginator')->paginate(
      $listeDetails,
      $page
    );

        if ($page < 1) {
            throw $this->createNotFoundException('Page '.$page.' inexistante.');
        }

        return $this->render('@OCAS/Detail/list.html.twig', array(
        'details' => $details,
        'id_session' => $session_id,
        'h1' => "Liste des stagiaires pour la formation X"
    ));
    }

    /**
     * @Route("/session/{session_id}/stagiaire/add/",name="detail_add",requirements={"session_id"="\d*"})
     */
    public function addAction($session_id, Request $request)
    {
        $detail= new Detail_formation();
        $form = $this->createForm(DetailType::class, $detail);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($detail);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Enregistré');
            return $this->redirectToRoute('');
        }
        return $this->render('@OCAS/Detail/form.html.twig', array(
        'h1' => "OCAS : ",
        'form' => $form->createView(),
      ));
    }

    /**
     * @Route("/session/{session_id}/stagiaire/{id}/edit",name="detail_edit",requirements={"session_id"="\d*", "id"="\d*"})
     */
    public function editAction($session_id, $id, Request $request)
    {


    }

    /**
     * @Route("/session/{session_id}/stagiaire/{id}/delete",name="detail_delete",requirements={"session_id"="\d*", "id"="\d*"})
     */
    public function deleteAction($session_id, $id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $detail = $em->getRepository('OCASBundle:Detail_formation')->find($id);

        if (null === $detail) {
            throw new NotFoundHttpException("L'inscription du stagiaire demandée n'existe pas");
        }
        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->remove($detail);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info', "L'inscription a bien été supprimée");

            return $this->redirectToRoute('detail_list', array('session_id' => $session_id));
        }
        return $this->render('@OCAS/Detail/delete.html.twig', array(
        'detail' => $detail,
        'form' => $form->createView(),
        'id_session' => $session_id
      ));
    }
}
