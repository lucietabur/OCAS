<?php

namespace OCAS\OCASBundle\Controller;

use OCAS\OCASBundle\Entity\Stagiaire;
use OCAS\OCASBundle\Form\StagiaireType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @Route("/stagiaire/{id}/formations/",name="stagiaire_formation",defaults={"id"="1"},requirements={"id"="\d*"})
     */
    public function listFormationAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $stagiaire = $em->getRepository('OCASBundle:Stagiaire')->find($id);
        $repository = $this->getDoctrine()->getRepository('OCASBundle:Session');
        $sessions = $repository->findSessionByStagiaire($stagiaire);

        return $this->render('@OCAS/Stagiaire/list_formation.html.twig', array(
          'stagiaire' => $stagiaire,
          'sessions' => $sessions,
          'h1' => 'OCAS : Liste des formations effectuées par : ',
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
            $nextAction = $form->get('enregistrer&suivant')->isClicked() ? 'stagiaire_add' : 'stagiaire_list';
            return $this->redirectToRoute($nextAction);
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
     * @Route("/stagiaire/search/",name="stagiaire_search")
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
     * @Route("/stagiaire/{libelle}/search", name="search_session")
     */
    public function searchSessionAction(Request $request,$libelle)
    {
      if($request->isXmlHttpRequest())
      {
          if(!empty($libelle))
          {
              $repository = $this->getDoctrine()->getManager()->getRepository('OCASBundle:Session');
              $sessions = $repository->findByLibelle($libelle);
              
              if (!empty($sessions)){
                $data = array();
                foreach ($sessions as $session) {
                  $array = array();
                  $array['id'] = $session->getId();
                  $array['num'] = $session->getNumEmargement();
                  $array['date_debut'] = $session->getDateDebut();
                  $array['date_fin'] = $session->getDateFin();
                  $array['groupe'] = $session->getGroupe();
                  $array['lieu'] = $session->getLieu();
                  $array['observation'] = $session->getObservation();
                  $array['intervenants'] = $session->getIntervenants();
                  $array['libelle_formation'] = $session->getLibelleFormation()->getLibelle();
                  $data[]= $array;
                }
                $response = new JsonResponse($data);
                $response->headers->set('Content-Type', 'application/json');
                return $response;
              }
              else{
                throw $this->createNotFoundException('No session found with this name');
                $response = new JsonResponse();
                $response->setContent('Pas de session correspondante');
                $response->setStatusCode(404);
                return $response;
              }
          }
          else{
            throw $this->createNotFoundException('Unable to find session');
          }

      }
  }

}
