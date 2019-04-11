<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoteRepository")
 */
class Vote
{
    public function __toString()
    {
        return $this->question;
    }
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $question;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $option1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $option2;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Polling", mappedBy="Answer")
     */
    private $pollings;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Polling", mappedBy="voting_id")
     */
    private $voting_id;



    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Polling", mappedBy="Voting_id")
     */
    private $Voting_id;




    /**
     * @ORM\Column(type="datetime")
     */
    private $datetime;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="CommentID")
     */
    private $CommentID;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="Comment")
     */
    private $Comment;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="VoteID")
     */
    private $VoteIDCo;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $likes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Supporting", mappedBy="vote")
     */
    private $supportings;



    public function __construct()
    {
        $this->pollings = new ArrayCollection();
        $this->voting_id = new ArrayCollection();
        $this->Voting_id = new ArrayCollection();
        $this->CommentID = new ArrayCollection();
        $this->Comment = new ArrayCollection();
        $this->VoteIDCo = new ArrayCollection();
        $this->supportings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getOption1(): ?string
    {
        return $this->option1;
    }

    public function setOption1(string $option1): self
    {
        $this->option1 = $option1;

        return $this;
    }

    public function getOption2(): ?string
    {
        return $this->option2;
    }

    public function setOption2(string $option2): self
    {
        $this->option2 = $option2;

        return $this;
    }


    /**
     * @return Collection|Polling[]
     */
    public function getPollings(): Collection
    {
        return $this->pollings;
    }

    public function addPolling(Polling $polling): self
    {
        if (!$this->pollings->contains($polling)) {
            $this->pollings[] = $polling;
        }

        return $this;
    }

    public function removePolling(Polling $polling): self
    {
        if ($this->pollings->contains($polling)) {
            $this->pollings->removeElement($polling);
            // set the owning side to null (unless already changed)

        }

        return $this;
    }

    /**
     * @return Collection|Polling[]
     */
    public function getVotingId(): Collection
    {
        return $this->Voting_id;
    }

    public function addVotingId(Polling $votingId): self
    {
        if (!$this->Voting_id->contains($votingId)) {
            $this->Voting_id[] = $votingId;
            $votingId->setVotingId($this);
        }

        return $this;
    }

    public function removeVotingId(Polling $votingId): self
    {
        if ($this->Voting_id->contains($votingId)) {
            $this->Voting_id->removeElement($votingId);
            // set the owning side to null (unless already changed)
            if ($votingId->getVotingId() === $this) {
                $votingId->setVotingId(null);
            }
        }

        return $this;
    }




    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getCommentID(): Collection
    {
        return $this->CommentID;
    }

    public function addCommentID(Comment $commentID): self
    {
        if (!$this->CommentID->contains($commentID)) {
            $this->CommentID[] = $commentID;
            $commentID->setCommentID($this);
        }

        return $this;
    }

    public function removeCommentID(Comment $commentID): self
    {
        if ($this->CommentID->contains($commentID)) {
            $this->CommentID->removeElement($commentID);
            // set the owning side to null (unless already changed)
            if ($commentID->getCommentID() === $this) {
                $commentID->setCommentID(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComment(): Collection
    {
        return $this->Comment;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->Comment->contains($comment)) {
            $this->Comment[] = $comment;
            $comment->setComment($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->Comment->contains($comment)) {
            $this->Comment->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getComment() === $this) {
                $comment->setComment(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getVoteIDCo(): Collection
    {
        return $this->VoteIDCo;
    }

    public function addVoteIDCo(Comment $voteIDCo): self
    {
        if (!$this->VoteIDCo->contains($voteIDCo)) {
            $this->VoteIDCo[] = $voteIDCo;
            $voteIDCo->setVoteID($this);
        }

        return $this;
    }

    public function removeVoteIDCo(Comment $voteIDCo): self
    {
        if ($this->VoteIDCo->contains($voteIDCo)) {
            $this->VoteIDCo->removeElement($voteIDCo);
            // set the owning side to null (unless already changed)
            if ($voteIDCo->getVoteID() === $this) {
                $voteIDCo->setVoteID(null);
            }
        }

        return $this;
    }

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    public function setLikes(?int $likes): self
    {
        $this->likes = $likes;

        return $this;
    }

    /**
     * @return Collection|Supporting[]
     */
    public function getSupportings(): Collection
    {
        return $this->supportings;
    }

    public function addSupporting(Supporting $supporting): self
    {
        if (!$this->supportings->contains($supporting)) {
            $this->supportings[] = $supporting;
            $supporting->setVote($this);
        }

        return $this;
    }

    public function removeSupporting(Supporting $supporting): self
    {
        if ($this->supportings->contains($supporting)) {
            $this->supportings->removeElement($supporting);
            // set the owning side to null (unless already changed)
            if ($supporting->getVote() === $this) {
                $supporting->setVote(null);
            }
        }

        return $this;
    }



}
