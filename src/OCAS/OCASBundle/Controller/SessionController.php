<?php

namespace OCAS\OCASBundle\Controller;

use OCAS\OCASBundle\Entity\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use OCAS\OCASBundle\Form\SessionType;
use OCAS\OCASBundle\Form\SearchType;
use OCAS\OCASBundle\Form\MissionType;
use OCAS\OCASBundle\Form\FeuilleType;
use OCAS\OCASBundle\Form\StagiaireMissionType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
// Include the BinaryFileResponse and the ResponseHeaderBag
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

// Include the requires classes of Phpword
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\IOFactory;

use \Doctrine\Common\Util\Debug;
class SessionController extends Controller
{
    /**
     * @Route("/sessions/{page}",name="session_list",defaults={"page"=1})
     */
    public function listAction($page = 1)
    {
        $repository = $this->getDoctrine()->getRepository('OCASBundle:Session');
        $listeSessions = $repository->findAll();
        $listePresent=array();
        $repository = $this->getDoctrine()->getRepository('OCASBundle:Detail_session');
        if ($listeSessions !== []){
          foreach ($listeSessions as $session) {
            $countPresentSession = $repository->countPresentSession($session);
            $listePresent[]=$countPresentSession[0];

            $countInscritSession = $repository->countInscritSession($session);
            $listeInscrit[]=$countInscritSession[0];
          }
        }
        else{
          $sessions = [];
          $listeInscrit = [];
          $listePresent = [];
        }
        $sessions = $this->get('knp_paginator')->paginate(
          $listeSessions,
          $page
        );

        if ($page < 1) {
            throw $this->createNotFoundException('Page '.$page.' inexistante.');
        }
        return $this->render('@OCAS/Session/list.html.twig', array(
          'sessions' => $sessions,
          'listePresent' => $listePresent,
          'listeInscrit' => $listeInscrit,
          'h1' => 'Liste des sessions'
      ));
    }

    /**
     * @Route("/sessions-retour/{page}",name="session_retour",defaults={"page"=1})
     */
    public function listRetourAction($page = 1)
    {
        $repository = $this->getDoctrine()->getRepository('OCASBundle:Detail_session');
        $listeSessions = $repository->retourSession();
        $listePresent=array();
        $listeInscrit=array();
        foreach ($listeSessions as $session) {
          $countPresentSession = $repository->countPresentSession($session);
          $listePresent[]=$countPresentSession[0];

          $countInscritSession = $repository->countInscritSession($session);
          $listeInscrit[]=$countInscritSession[0];
        }
        $sessions = $this->get('knp_paginator')->paginate(
        $listeSessions,
        $page
      );

        if ($page < 1) {
            throw $this->createNotFoundException('Page '.$page.' inexistante.');
        }

        return $this->render('@OCAS/Session/list_retour.html.twig', array(
          'sessions' => $sessions,
          'listePresent' => $listePresent,
          'listeInscrit' => $listeInscrit,
          'h1' => 'Liste des sessions'
      ));
    }

    /**
     * @Route("/formations/{id}/sessions/{page}",name="session_libelle",defaults={"page"=1},requirements={"id"="\d*"})
     */
    public function listSessionsByLibelleAction($id,$page = 1)
    {
      $repository = $this->getDoctrine()->getRepository('OCASBundle:Session');
      $libelle=$repository->findById($id);

      $listeSessions = $repository->findByLibelle($libelle);

      $listePresent=array();
      $listeInscrit=array();
      $repository = $this->getDoctrine()->getRepository('OCASBundle:Detail_session');
      foreach ($listeSessions as $session) {
        $countPresentSession = $repository->countPresentSession($session);
        $listePresent[]=$countPresentSession[0];

        $countInscritSession = $repository->countInscritSession($session);
        $listeInscrit[]=$countInscritSession[0];
      }

      $sessions = $this->get('knp_paginator')->paginate(
      $listeSessions,
      $page
    );

      if ($page < 1) {
          throw $this->createNotFoundException('Page '.$page.' inexistante.');
      }

      return $this->render('@OCAS/Session/list.html.twig', array(
        'sessions' => $sessions,
        'listePresent' => $listePresent,
        'listeInscrit' => $listeInscrit,
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
     * @Route("/session/{id}/generate/choice",name="session_generate",defaults={"id"="1"},requirements={"id"="\d*"})
     */
    public function generateChoice($id,Request $request)
    {
      $em = $this->getDoctrine()->getManager();
      $session = $em->getRepository('OCASBundle:Session')->find($id);

      return $this->render('@OCAS/PDF/choice.html.twig', array(
        'h1' => "OCAS : Génerer les documents",
        'session' => $session
       ));
    }

    /**
     * @Route("/session/{id}/generate/mission",name="session_mission",defaults={"id"="1"},requirements={"id"="\d*"})
     */
     public function generateMission($id,Request $request)
     {
       $em = $this->getDoctrine()->getManager();
       $session = $em->getRepository('OCASBundle:Session')->find($id);
       $stagiaires = $em->getRepository('OCASBundle:Session')->findInscrits($session);
       //rechercher la formation
       $libelle = $em->getRepository('OCASBundle:Session')->findLibelleBySession($id);
       //tableau regroupant le stagiaire, son agence et son siege
       $infos_stagiaires= array();
       foreach ($stagiaires as $stagiaire) {
         $agence=$stagiaire->getAgence();
         $siege=$agence->getSiege();
         $infos_stagiaires[$stagiaire->getId()]=array($stagiaire,
                                                    $agence,
                                                     $siege);
       }
       $defaultData = array(
         'date_edition' => new \DateTime('01-01-2018'),
         'date_formation' => $session->getDateDebut(),
         'libelle' =>$libelle[0]['libelle'],
         'lieu' => 'Rectorat – Salle ',
         'stagiaires' => $stagiaires
       );

       //creation du formulaire
       $form = $this->createForm(MissionType::class, $defaultData, array(
         'method' => 'POST',

       ));
       // soumission du formulaire

      if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
           $data = $form->getData();
           $stagiaires = $form->get('stagiaires')->getData();
          //generer le fichier
          $tbs = $this->container->get('opentbs');
          $this->get('OCAS\OCASBundle\Services\GenerateDoc')->generateMissionDoc($form,$tbs,$stagiaires);

           //on enregistre que la feuille de mission a été générée
          $session = $this->getDoctrine()->getManager()->find($id);
          $session->setMissionEdite(1);
       }

       return $this->render('@OCAS/PDF/Ordre/form.html.twig', array(
         'stagiaires' =>  $stagiaires,
         'h1' => "OCAS : Génerer l'odre de mission pour :".$libelle[0]['libelle'],
         'form' => $form->createView(),
         'id' => $id
        ));
     }

    /**
     * @Route("/session/{id}/generate/feuille",name="session_feuille",defaults={"id"="1"},requirements={"id"="\d*"})
     */
    public function generateFeuille($id,Request $request)
    {
      $em = $this->getDoctrine()->getManager();
      // find Session
      $session = $em->getRepository('OCASBundle:Session')->find($id);
      // on calcule l'ecart entre date_debut et date_fin
      // le nb de jours = le nb de date à créer d'avance

      //données du formulaire
      $defaultData = array(
        'date_edition' => new \DateTime(),
        'dates' => array($session->getDateDebut(),$session->getDateFin()),
      );

      //creation du formulaire
      $form = $this->createForm(FeuilleType::class, $defaultData, array(
        'method' => 'POST',

      ));
      // soumission du formulaire
      $form->handleRequest($request);
      if ($request->isMethod('POST') && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        // find Session
        $session = $em->getRepository('OCASBundle:Session')->find($id);
        // find libelle
        $libelle = $em->getRepository('OCASBundle:Session')->findLibelleBySession($id);
        // find stagiaires inscrits
        $stagiaires = $em->getRepository('OCASBundle:Session')->findInscrits($id);
        $data = $form->getData();
         //generer le fichier

        $tbs = $this->container->get('opentbs');
        $data = $form->getData();
        $this->get('OCAS\OCASBundle\Services\GenerateDoc')->generateFeuilleDoc($session,$libelle,$stagiaires,$data,$tbs);
          //on enregistre que la feuille de mission a été générée
         $session = $this->getDoctrine()->getManager()->find($id);
         $session->setFeuilleEdite(1);
         return $this->redirectToRoute('session_list');
   }
    return $this->render('@OCAS/PDF/Feuille/form.html.twig', array(
      'h1' => "OCAS : Génerer l'odre de mission",
      'form' => $form->createView(),
      'id' => $id
     ));
    }
}
