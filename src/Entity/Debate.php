<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DebateRepository")
 * @UniqueEntity("title",  message="This title is already used by another debate")
 * 
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
    private $description;

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
     * @ORM\Column(type="text", length=255)
     */
    private $side1;

    /**
     * @ORM\Column(type="text", length=255)
     */
    private $side2;

     /**
     * @ORM\Column(type="integer")
     */
    private $side1_votes;

    /**
     * @ORM\Column(type="integer")
     */
    private $side2_votes;

    /**
     * @ORM\Column(type="integer")
     */
    private $total_votes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="debate", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Vote", mappedBy="debate", cascade={"persist", "remove"})
     */
    private $vote;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="debate")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    /**
     * TODO: mettre des vérifications dans tous les setters
    */
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
    
    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
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

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setDebateId($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getDebateId() === $this) {
                $comment->setDebateId(null);
            }
        }

        return $this;
    }

    public function getVote(): ?Vote
    {
        return $this->vote;
    }

    public function setVote(Vote $vote): self
    {
        $this->vote = $vote;

        // set the owning side of the relation if necessary
        if ($this !== $vote->getDebate()) {
            $vote->setDebate($this);
        }

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Is the given User the author of this Debate?
     *
     * @return bool
     */
    public function isAuthor(User $user = null)
    {
        return $user && $user->getPseudo() === $this->getOwner()->getPseudo();
    }
}
