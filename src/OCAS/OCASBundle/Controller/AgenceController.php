<?php

namespace OCAS\OCASBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AgenceController extends Controller
{
    /**
     * @Route("/agence/add")
     */
    public function addAction()
    {
        return $this->render('OCASBundle:Agence:form.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/agence/edit")
     */
    public function editAction()
    {
        return $this->render('OCASBundle:Agence:form.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/agence/delete")
     */
    public function deleteAction()
    {
        return $this->render('OCASBundle:Agence:delete.html.twig', array(
            // ...
        ));
    }

}
