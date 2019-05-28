<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DebateRepository")
 */
class Debate
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="text", length=99)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="text", length=50)
     */
    private $category;

    /**
     * @ORM\Column(type="text", length=50)
     */
    private $author;

     /**
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(type="integer")
     */
    private $votes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title;
    }
    
    public function getContent(){
        return $this->content;
    }

    public function setContent($content){
        $this->content = $content;
    }

    public function getCategory(){
        return $this->category;
    }

    public function setCategory($category){
        $this->category = $category;
    }

    public function getAuthor(){
        return $this->author;
    }
    /**
     * TODO: set author en fonction de l'utilisateur connecté
      */
    public function setAuthor($author){
        $this->author = $author;
    }

    public function getCreated(){
        return date_format($this->created, 'Y-m-d H:i:s');
    }

    public function setCreated($created){
        $this->created = new \DateTime("now");
    }

    public function getVotes(){
        return $this->votes;
    }
    /**
     * TODO: set votes en fonction de plus ou moins (upvote / downvote)
      */
    public function setVotes($votes){
        $this->votes = $votes;
    }
}
