<?php

namespace OCAS\OCASBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use OCAS\OCASBundle\Entity\Detail_emargement;
use OCAS\OCASBundle\Form\DetailType;

class Detail_emargementController extends Controller
{

  /**
   * @Route("/feuille/{id}/stagiaires/{page}",name="detail_list",defaults={"page"=1})
   */
  public function listAction($page = 1)
  {


      return $this->render('@OCAS/Feuille/list.html.twig', array(
      ));
  }
    /**
     * @Route("/feuille/{id}/add/stagiaire/",name="detail_add",defaults={"id"="1"},requirements={"id"="\d*"})
     */
    public function addAction($id, Request $request)
    {
        // on recherche la feuille correspondant à l'id et on l'ajoute à l'objet detail
        $em = $this->getDoctrine()->getManager();
        $feuille = $em->getRepository('OCASBundle:Feuille_emargement')->find($id);
        $detail = new Detail_emargement();
        $detail->setFeuilleEmargement($feuille); //TODO: ErrorException
        $form = $this->createForm(DetailType::class,$detail);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
          $em = $this->getDoctrine()->getManager();
          $em->persist($detail);
          $em->flush();
          $request->getSession()->getFlashBag()->add('notice','Stagiaire bien enregistré•e.');
          return $this->redirectToRoute('detail_list');
        }

        $toto=$feuille->getFormation()->getLibelle();
        return $this->render('@OCAS/Detail/add.html.twig', array(
            'h1' => "Ajouter un stagiaire à la formation : ".$toto,
            'form' => $form->createView(),
            'id_feuille' => $id
        ));
    }

    /**
     * @Route("/edit")
     */
    public function editAction()
    {
        return $this->render('OCASBundle:Detail_emargement:edit.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/delete")
     */
    public function deleteAction()
    {
        return $this->render('OCASBundle:Detail_emargement:delete.html.twig', array(
            // ...
        ));
    }

}
