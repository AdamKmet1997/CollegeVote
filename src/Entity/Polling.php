<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PollingRepository")
 */
class Polling
{
    public function __toString()
    {
        return $this->Ans;

    }


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="User_id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vote", inversedBy="Voting_id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Voting_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Ans;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->User_id;
    }

    public function setUserId(?User $User_id): self
    {
        $this->User_id = $User_id;

        return $this;
    }

    public function getVotingId(): ?Vote
    {
        return $this->Voting_id;
    }

    public function setVotingId(?Vote $Voting_id): self
    {
        $this->Voting_id = $Voting_id;

        return $this;
    }

    public function getAns(): ?string
    {

        return $this->Ans;
    }

    public function setAns(string $Ans): self
    {
        $this->Ans = $Ans;

        return $this;
    }

}
