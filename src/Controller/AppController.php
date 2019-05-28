<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AppController extends AbstractController
{
    public function index()
    {
        return $this->render('app/index.html.twig', [
            'controller_name' => 'Utilisateur',
        ]);
    }

    public function add()
    {
    	return new Response('<h1>Ajouter un article</h1>');
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
