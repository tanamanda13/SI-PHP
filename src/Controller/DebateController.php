<?php
namespace App\Controller;

use App\Entity\Debate;
use App\Service\Relativetime;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DebateController extends AbstractController {
  
  /**
  * @Route("/", name="debate_list")
  * @Method("GET")
  */
  public function index(Relativetime $relativetime){
    /**
     * TODO: Changer la date écrite en dur par la date du debat & faire la même chose pour la page show
      */
    $processed = $relativetime->time_elapsed_string('2010-04-28 17:25:43');
    \var_dump($processed);

    $debates = $this->getDoctrine()->getRepository(Debate::class)->findAll();
    return $this->render('debates/index.html.twig', array('debates'=>$debates)); 
  }
  
  /**
  * @Route("/debate/{id}", name="debate_show")
  * @Method("GET")
  */
  public function show($id){
    $debate = $this->getDoctrine()->getRepository(Debate::class)->find($id);

    return $this->render('debates/show.html.twig', array('debate'=>$debate)); 
  }
}