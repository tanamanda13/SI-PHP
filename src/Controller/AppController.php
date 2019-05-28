<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Post;
use App\Form\PostType;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="app_index", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        $post->setAuthor($this->getUser()->getusername());
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('post_index');
        }

        return $this->render('app/index.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
            'user_name' => $this->getUser()->getUserName(),
        ]);
    }

    public function show($url = 1)
    {
    	return $this->render('app/show.html.twig', [
            'slug' => $url,
        ]);
    }

    public function edit($id = 1)
    {
    	return $this->render('app/edit.html.twig', [
            'slug' => $id,
        ]);
    }

    public function remove($id)
    {
    	return new Response('<h1>Supprimer l\'article ' .$id. '</h1>');
    }
}
