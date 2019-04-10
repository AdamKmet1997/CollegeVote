<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    public function __toString()
    {
        return $this->username;
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Polling", mappedBy="User_ID")
     */
    private $Vote_ID;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Polling", mappedBy="User_ID")
     */
    private $User_ID;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Polling", mappedBy="User_id")
     */
    private $User_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="UserID")
     */
    private $commentID;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="UserID")
     */
    private $UserID;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="UserID")
     */
    private $UserIdCo;



    public function __construct()
    {
        $this->Vote_ID = new ArrayCollection();
        $this->User_ID = new ArrayCollection();
        $this->User_id = new ArrayCollection();
        $this->commentID = new ArrayCollection();
        $this->UserID = new ArrayCollection();
        $this->UserIdCo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles()
    {
        return $this->roles;
    }


    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|Polling[]
     */
    public function getUserId(): Collection
    {
        return $this->User_id;
    }

    public function addUserId(Polling $userId): self
    {
        if (!$this->User_id->contains($userId)) {
            $this->User_id[] = $userId;
            $userId->setUserId($this);
        }

        return $this;
    }

    public function removeUserId(Polling $userId): self
    {
        if ($this->User_id->contains($userId)) {
            $this->User_id->removeElement($userId);
            // set the owning side to null (unless already changed)
            if ($userId->getUserId() === $this) {
                $userId->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getCommentID(): Collection
    {
        return $this->commentID;
    }

    public function addCommentID(Comment $commentID): self
    {
        if (!$this->commentID->contains($commentID)) {
            $this->commentID[] = $commentID;
            $commentID->setUserID($this);
        }

        return $this;
    }

    public function removeCommentID(Comment $commentID): self
    {
        if ($this->commentID->contains($commentID)) {
            $this->commentID->removeElement($commentID);
            // set the owning side to null (unless already changed)
            if ($commentID->getUserID() === $this) {
                $commentID->setUserID(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getUserIdCo(): Collection
    {
        return $this->UserIdCo;
    }

    public function addUserIdCo(Comment $userIdCo): self
    {
        if (!$this->UserIdCo->contains($userIdCo)) {
            $this->UserIdCo[] = $userIdCo;
            $userIdCo->setUserID($this);
        }

        return $this;
    }

    public function removeUserIdCo(Comment $userIdCo): self
    {
        if ($this->UserIdCo->contains($userIdCo)) {
            $this->UserIdCo->removeElement($userIdCo);
            // set the owning side to null (unless already changed)
            if ($userIdCo->getUserID() === $this) {
                $userIdCo->setUserID(null);
            }
        }

        return $this;
    }







}
