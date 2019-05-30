<?php
namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Debate;
use App\Form\CommentFormType;
use App\Form\DebateFormType;
use App\Repository\CommentRepository;
use App\Repository\DebateRepository;
use App\Service\Relativetime;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security as coreSecurity;

class DebateController extends AbstractController
{

    /**
     * @Route("/", name="root")
     */
    public function rootRedirect()
    {
        return $this->redirectToRoute('debate_list');
    }

    /**
     * @Route("/me", name="profile")
     * @Method("GET")
     */
    public function profile(DebateRepository $debates)
    {
        return $this->render('debates/profile.html.twig', [
            "username" => $this->getUser()->getPseudo(),
            "posts" => $debates->findByAuthor($this->getUser()->getPseudo()),
        ]);
    }
    /**
     * @Route("/home/{order}", name="debate_list", defaults={"order"="created"},)
     * @Method("GET")
     */
    public function index($order, Request $request, PaginatorInterface $paginator, Relativetime $relativetime, DebateRepository $debates)
    {

        $lastDebates = $paginator->paginate($debates->findAllQuery($order),
            $request->query->getInt('page', 1), 5);
        $results = [];
        foreach ($lastDebates as $debate) {
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
                'total_votes' => $debate->getTotal_votes(),
            ];
        }
        return $this->render('debates/index.html.twig',
            ['debates' => $results,
                'pagination' => $lastDebates]);
    }
    /**
     *
     * @Route ("/search", name = "home_search")
     */
    public function search(DebateRepository $debates, Request $request, PaginatorInterface $paginator)
    {
        $toSearch = $_POST['search'];

        $lastDebates = $paginator->paginate($debates->findLikeTitle($toSearch), $request->query->getInt('page', 1), 5);

        $results = $debates->findLikeTitle($toSearch);
        return $this->render('debates/index.html.twig', [
            'debates' => $results,
            'pagination' => $lastDebates,
        ]);
    }

/**
 * @Route("/debate/new", name="new_debate")
 * @Method({"GET", "POST"})
 */
    function new (Request $request, coreSecurity $security) {
        $debate = new Debate();
        $user = $security->getUser();

        //Met l'owner du debat
        $debate->setOwner($user);
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

        if ($form->isSubmitted() && $form->isValid()) {
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
     * @Method({"GET", "POST"})
     */
    public function show($id, Relativetime $relativetime, CommentRepository $commentRepo, DebateRepository $debates, Request $request, PaginatorInterface $paginator, coreSecurity $security)
    {

        $debate = $debates->find($id);

        //Affichage les commentaires
        $sort = $request->query->get('sorting-by');
        $lastComments = $paginator->paginate($commentRepo->findAllforDebateQuery($sort, $debate),
            $request->query->getInt('page', 1), 5);
        //Modifie les données des commentaires à afficher
        $resultComment = [];
        foreach ($lastComments as $comment) {
            $comment->getAgree() === 1 ? $side = $debate->getSide1() : $side = $debate->getSide2();
            $datetimeComment = $comment->getCreated();
            $processed = $relativetime->time_elapsed_string($datetimeComment);
            $resultComment[] = [
                'id' => $comment->getId(),
                'side' => $side,
                'author' => $comment->getAuthor(),
                'content' => $comment->getContent(),
                'created' => $processed,
                'votes' => $comment->getVotes(),
                'reference' => $comment,
            ];
        }
        //Gère le formulaire du commentaire
        $user = $security->getUser();
        $comment = new Comment();
        $comment->setDebate($debate);
        $comment->setOwner($user);
        $comment->setCreated();
        $comment->setVotes(0);
        $comment->setAuthor($this->getUser()->getPseudo());

        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            if ($comment->getAgree() == 1) {
                $debate->setside1_votes($debate->getSide1_votes() + 1);
            } else if ($comment->getAgree() == 2) {
                $debate->setSide2_votes($debate->getSide2_votes() + 1);
            }

            $debate->setTotal_votes($debate->getTotal_votes() + 1);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('debate_show', ['id' => $id]);
        }

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
            'total_votes' => $debate->getTotal_votes(),
        ];

        return $this->render(
            'debates/show.html.twig',
            array('debate' => $result,
                'form' => $form->createView(),
                'pagination' => $lastComments,
                'comments' => $resultComment,
                'debateObj' => $debate,
            )
        );
    }

    /**
     * @Route("/debate/{id}/delete", name="debate_delete")
     * @Security("debate.isAuthor(user)")
     */
    public function deleteDebate(Debate $debate)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($debate);
        $entityManager->flush();
        return $this->redirectToRoute('debate_list');
    }

    /**
     * @Route("/comment/{id}/delete", name="comment_delete")
     * @Security("comment.isAuthor(user)")
     */
    public function deleteComment(Comment $comment)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($comment);
        $entityManager->flush();
        return $this->redirectToRoute('debate_show', ['id' => $comment->getDebate()->getId()]);
    }

    /**
     * @Route("/update", name="update_route")
     * @Method("POST")
     */
    public function update()
    {

        // Ajax data
        $id = $_POST['id'];
        $side = $_POST['side'];

        // Get debate from database
        $debate = $this->getDoctrine()
            ->getRepository(Debate::class)
            ->find($id);

        // Changing votes values
        if ($side === "side1") {
            $debateSide1 = $debate->getSide1_votes();
            $debate->setSide1_votes(1 + $debateSide1);
        } else {
            $debateSide2 = $debate->getSide2_votes();
            $debate->setSide2_votes(1 + $debateSide2);
        }
        $debate->setTotal_votes($debate->getSide1_votes() + $debate->getSide2_votes());

        // Database save
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($debate);
        $entityManager->flush();

        return new Response('Check out this great debate: ' . $debate->getTitle());
    }

}
