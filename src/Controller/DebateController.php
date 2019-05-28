<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DebateController extends Controller {
  /**
  * @Route("/")
  * @Method("GET")
  */

  public function index(){
    $debates = ['Debate1', 'Debate2'];

    return $this->render('debates/index.html.twig', array('debates'=>$debates)); 
  }
}