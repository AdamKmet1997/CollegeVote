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
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="UserIdCo")
     * @ORM\JoinColumn(nullable=false)
     */
    private $UserID;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vote", inversedBy="VoteIDCo")
     * @ORM\JoinColumn(nullable=false)
     */
    private $VoteID;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Comment;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserID(): ?User
    {
        return $this->UserID;
    }

    public function setUserID(?User $UserID): self
    {
        $this->UserID = $UserID;

        return $this;
    }

    public function getVoteID(): ?Vote
    {
        return $this->VoteID;
    }

    public function setVoteID(?Vote $VoteID): self
    {
        $this->VoteID = $VoteID;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->Comment;
    }

    public function setComment(string $Comment): self
    {
        $this->Comment = $Comment;

        return $this;
    }
}
