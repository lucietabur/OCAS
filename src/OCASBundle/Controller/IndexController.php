<?php

namespace OCASBundle\Controller;

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
      return $this->render('index.html.twig');
    }

}
