<?php
namespace App\Controller;

use App\Entity\Debate;
use App\Service\Relativetime;
use App\Repository\DebateRepository;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DebateController extends AbstractController {
  
  /**
  * @Route("/", name="debate_list")
  * @Method("GET")
  */
  public function index(Relativetime $relativetime, DebateRepository $debates){
    /* $allDebates = findAll(''); */
    $limit = 5;
    $offset = 0;
    $lastDebates = $debates->findBy(array(), null, $limit, $offset);
    $results = [];
    foreach($lastDebates as $debate){
      $datetime = $debate->getCreated();
      $processed = $relativetime->time_elapsed_string($datetime);
      $results[] = [
        'id' => $debate->getId(),
        'title' => $debate->getTitle(),
        'content' => $debate->getContent(),
        'category' => $debate->getCategory(),
        'author' => $debate->getAuthor(),
        'created' => $processed,
        'votes' => $debate->getVotes()
      ];
    }
    return $this->render('debates/index.html.twig', array('debates'=>$results)); 
  }
  
  /**
  * @Route("/debate/{id}", name="debate_show")
  * @Method("GET")
  */
  public function show($id, Relativetime $relativetime, DebateRepository $debates){
  
    $debate = $debates->find($id);
    $datetime = $debate->getCreated();
    $processed = $relativetime->time_elapsed_string($datetime);
    $result = [
      'id' => $debate->getId(),
      'title' => $debate->getTitle(),
      'content' => $debate->getContent(),
      'category' => $debate->getCategory(),
      'author' => $debate->getAuthor(),
      'created' => $processed,
      'votes' => $debate->getVotes()
    ];

    return $this->render('debates/show.html.twig', array('debate'=>$result)); 
  }
}