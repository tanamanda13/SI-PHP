<?php
namespace App\Controller;

use App\Entity\Debate;
use App\Service\Relativetime;
use App\Repository\DebateRepository;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Components\Form\Extension\Core\Type\TextType;
use Symfony\Components\Form\Extension\Core\Type\TextAreaType;
use Symfony\Components\Form\Extension\Core\Type\SubmitType;
use Symfony\Components\Form\Extension\Core\Type\ChoiceType;

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
    return $this->render('debates/index.html.twig', array('debates'=>$results)); 
  }
  /**
  * @Route("/debate/new", name="new_debate")
  * @Method("GET", "POST)
  */
  public function new(Request $request){
    $debate = new Debate();
    $categories = ['Alimentation', 'Science', 'Sport', 'TV réalité', 'Style', 'Voyage', 'Médecine'];

    $form = $this->createFormBuilder($article)
      ->add('title', TextType::class, array('attr' => array('class' => 'form-control')))
      ->add('description', TextType::class, array('attr' => array('class' => 'form-control')))
      ->add('Side A', TextType::class, array('attr' => array('class' => 'form-control')))
      ->add('Side B', TextType::class, array('attr' => array('class' => 'form-control')))
      ->add('Category', ChoiceType::class, array(
        'attr' => array('class' => 'form-control'),
        'placeholder' => 'Choose a category',
        'choices' => $categories
        ))
      ->add('save', SubmitType::class, array(
        'label'=> 'Create',
        'attr' => array('class' => 'btn btn-primary')
      ))
      ->getForm();
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
}