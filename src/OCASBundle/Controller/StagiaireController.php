<?php

namespace OCASBundle\Controller;

use OCASBundle\Entity\Stagiaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use OCASBundle\Form\StagiaireType;


class StagiaireController extends Controller
{
    /**
     * @Route("/stagiaires/{page}/",name="stagiaire_list",defaults={"page"="1"},requirements={"page"="\d*"})
     */
    public function listAction($page)
    {
        $repository = $this->getDoctrine()->getRepository('OCASBundle:Stagiaire');
        $stagiaires = $repository->findAll();
        if ($page == null){
          $page=1;
        }
        else if ($page < 1){
          throw $this->createNotFoundException('Page '.$page.' inexistante.');
        }

        return $this->render('@OCAS/list.html.twig', array(
            'stagiaires' => $stagiaires
        ));
    }

    /**
     * @Route("/stagiaire/{id}/",name="stagiaire_view",defaults={"id"="1"},requirements={"id"="\d*"})
     */
    public function viewAction($id)
    {
        $repository = $this->getDoctrine()->getRepository('OCASBundle:Stagiaire');
        $stagiaire = $repository->find($id);
        if ($id == null){
          return $this->redirectToRoute('stagiaire_list');
        }
        return $this->render('@OCAS/view.html.twig', array(
            'id' => $id,
            'stagiaire' => $stagiaire
        ));
    }

    /**
     * @Route("stagiaire/add", name="stagiaire_add")
     */
    public function addAction(Request $request)
    {
        $stagiaire= new Stagiaire();
        $form = $this->createForm(StagiaireType::class,$stagiaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
          $em = $this->getDoctrine()->getManager();
          $em->persist($stagiaire);
          $em->flush();
          // a voir si on redirige vers la liste, le stagiaire créé ou plutot vers add
          $request->getSession()->getFlashBag()->add('notice','Stagiaire bien enregistré•e.');
          return $this->redirectToRoute('stagiaire_list');
        }
        return $this->render('@OCAS/form.html.twig', array(
          'h1' => "Ajouter un stagiaire",
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

        if ($id == null){
          $request->getSession()->getFlashBag()->add('notice',"Le stagiaire demandé n'a pas pu être trouvé");
          return $this->redirectToRoute('stagiaire_list');
          //on rajoutera a l'affichage "stagiaire demandé n'existe pas"
        }
        $form = $this->createForm(StagiaireType::class,$stagiaire);


        // soumission du formulaire
        if ($request->isMethod('POST')) {
          $em->flush();
          $request->getSession()->getFlashBag()->add('notice', 'Stagiaire bien modifié•e');
          return $this->redirectToRoute('stagiaire_view');
        }

        return $this->render('@OCAS/form.html.twig', array(
          'stagiaire' =>  $stagiaire,
          'h1' => "Modifier un stagiaire",
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

        if (null === $stagiaire){
          throw new NotFoundHttpException("Le stagiaire demandée n'existe pas");
        }
        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
          $em->remove($stagiaire);
          $em->flush();

          $request->getSession()->getFlashBag()->add('info',"Le stagiaire a bien été supprimée");

          return $this->redirectToRoute('stagiaire_list');
        }
        return $this->render('@OCAS/delete.html.twig', array(
          'stagiaire' => $stagiaire,
          'form' => $form->createView()
        ));

    }

}