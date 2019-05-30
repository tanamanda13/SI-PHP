<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoteRepository")
 */
class Vote
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="vote", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Author;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Debate", inversedBy="vote", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $debate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?User
    {
        return $this->Author;
    }

    public function setAuthor(User $Author): self
    {
        $this->Author = $Author;

        return $this;
    }

    public function getDebate(): ?Debate
    {
        return $this->debate;
    }

    public function setDebate(Debate $debate): self
    {
        $this->debate = $debate;

        return $this;
    }
}
