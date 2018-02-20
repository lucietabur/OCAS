<?php

namespace OCAS\OCASBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends Controller
{
  /**
  * @Route("/" ,name="home")
  */
    public function indexAction()
    {
      $menu = $this->get('OCAS\OCASBundle\Menu\Menu');
      return $this->render('index.html.twig');
    }

}
