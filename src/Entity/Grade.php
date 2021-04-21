<?php

namespace App\Entity;

use App\Repository\GradeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GradeRepository::class)
 */
class Grade
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $permLand;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $permeBank;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $permEntreprise;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="Grade")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPermLand(): ?bool
    {
        return $this->permLand;
    }

    public function setPermLand(?bool $permLand): self
    {
        $this->permLand = $permLand;

        return $this;
    }

    public function getPermeBank(): ?bool
    {
        return $this->permeBank;
    }

    public function setPermeBank(?bool $permeBank): self
    {
        $this->permeBank = $permeBank;

        return $this;
    }

    public function getPermEntreprise(): ?bool
    {
        return $this->permEntreprise;
    }

    public function setPermEntreprise(?bool $permEntreprise): self
    {
        $this->permEntreprise = $permEntreprise;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setGrade($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getGrade() === $this) {
                $user->setGrade(null);
            }
        }

        return $this;
    }
}
