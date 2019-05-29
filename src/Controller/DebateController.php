<?php
namespace App\Controller;

use App\Entity\Debate;
use App\Form\DebateFormType;
use App\Service\Relativetime;
use App\Repository\DebateRepository;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Knp\Component\Pager\PaginatorInterface;
use App\Entity\User;

class DebateController extends AbstractController {
  
  /**
  * @Route("/", name="debate_list")
  * @Method("GET")
  */
  public function index(Request $request, PaginatorInterface $paginator,Relativetime $relativetime, DebateRepository $debates){
    /**
     * TODO: échapper les données affichées
      */ 
    
    $lastDebates = $paginator->paginate($debates->findAllQuery(),
    $request->query->getInt('page', 1),5);
    $results = [];
    foreach($lastDebates as $debate){
      $datetime = $debate->getCreated();
      $processed = $relativetime->time_elapsed_string($datetime);
      $results[] = [
        'id' => $debate->getId(),
        'title' => $debate->getTitle(),
        'description' => $debate->getDescription(),
        'category' => $debate->getCategory(),
        'author' => $debate->getAuthor(),
        'created' => $processed,
        'side1' => $debate->getSide1(),
        'side2' => $debate->getSide2(),
        'side1_votes' => $debate->getSide1_votes(),
        'side2_votes' => $debate->getSide2_votes(),
        'total_votes' => $debate->getTotal_votes()
      ];
    }
    return $this->render('debates/index.html.twig',
      ['debates' => $results,
       'pagination'=> $lastDebates]); 
  }
    
  /**
  * @Route("/debate/new", name="new_debate")
  * @Method({"GET", "POST"})
  */
  public function new(Request $request){
    /**
    * TODO: échapper les données affichées
    */

    $debate = new Debate();
    /**
     * TODO: gérer la connexion et session et créer un UserController
      */
    
    //Met la date du moment
    $debate->setCreated(new \DateTime());
    //Met les votes à zéro
    $debate->setSide1_votes(0);
    $debate->setSide2_votes(0);
    $debate->setTotal_votes(0);
    //Met le pseudo de l'utilisateur actuel
    $debate->setAuthor($this->getUser()->getPseudo());

    $form = $this->createForm(DebateFormType::class, $debate);
    $form->handleRequest($request);
        /**
         * TODO:Ajouter une vraie vérification et échapper les données envoyées à la bdd
          */
    if($form->isSubmitted() && $form->isValid()) {
      $debate = $form->getData();

      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($debate);
      $entityManager->flush();

      return $this->redirectToRoute('debate_list');
    }

    return $this->render('debates/new.html.twig', array('form' => $form->createView()));
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
      'description' => $debate->getDescription(),
      'category' => $debate->getCategory(),
      'author' => $debate->getAuthor(),
      'created' => $processed,
      'side1' => $debate->getSide1(),
      'side2' => $debate->getSide2(),
      'side1_votes' => $debate->getSide1_votes(),
      'side2_votes' => $debate->getSide2_votes(),
      'total_votes' => $debate->getTotal_votes()
    ];

    return $this->render('debates/show.html.twig', array('debate'=>$result)); 
  }

  /**
   * @Route("/me", name="profile")
   * @Method("GET")
   */
  public function profile(DebateRepository $debates){
    return $this->render('debates/profile.html.twig', [
      "username" => $this->getUser()->getPseudo(),
      "posts" => $debates->findByAuthor($this->getUser()->getPseudo())
    ]);
  }
}