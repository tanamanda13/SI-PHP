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
     * TODO : lier a la table debate
      */

    /**
     * @ORM\Column(type="integer")
     */
    private $debate_id;

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
        return $this->description;
    }

    public function setContent($description){
        $this->description = $description;
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

    public function getSide1(){
        return $this->side1;
    }

    public function setSide1($side1){
        $this->side1 = $side1;
    }

    public function getSide2(){
        return $this->side2;
    }

    public function setSide2($side2){
        $this->side2 = $side2;
    }

    public function getSide1_votes(){
        return $this->side1_votes;
    }

    public function setSide1_votes($side1_votes){
        $this->side1_votes = $side1_votes;
    }
    public function getSide2_votes(){
        return $this->side2_votes;
    }

    public function setSide2_votes($side2_votes){
        $this->side2_votes = $side2_votes;
    }

    public function getTotal_votes(){
        return $this->total_votes;
    }

    public function setTotal_votes($total_votes){
        $this->total_votes = $total_votes;
    }
}
