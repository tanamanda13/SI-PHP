<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $agree;

     /**
     * @ORM\Column(type="text", length=50)
     */
    private $author;

    /**
     * @ORM\Column(type="text")
     */
     private $content;

    /**
    * @ORM\Column(type="datetime")
    */
   private $created;

   /**
     * @ORM\Column(type="integer")
     */
    private $votes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Debate", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $debate;

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

    public function getAgree(){
        return $this->agree;
    }
    public function setAgree($agree){
        $this->agree = $agree;
    }
    
    public function getContent(){
        return $this->content;
    }

    public function setContent($content){
        $this->content = $content;
    }

    public function getAuthor(){
        return $this->author;
    }

    public function setAuthor($author){
       $this->author = $author;
    }

    public function getCreated(){
        return date_format($this->created, 'Y-m-d H:i:s');
    }

    public function setCreated(){
        $this->created = new \DateTime("now");
    }

    public function getVotes(){
        return $this->votes;
    }

    public function setVotes($votes){
        $this->votes = $votes;
    }

    public function getDebate(): ?Debate
    {
        return $this->debate;
    }

    public function setDebate(?Debate $debate): self
    {
        $this->debate = $debate;

        return $this;
    }
}
