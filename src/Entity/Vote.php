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



    public function __construct()
    {
        $this->pollings = new ArrayCollection();
        $this->voting_id = new ArrayCollection();
        $this->Voting_id = new ArrayCollection();
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


}
