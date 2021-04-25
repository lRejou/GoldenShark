<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntrepriseRepository::class)
 */
class Entreprise
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
     * @ORM\OneToMany(targetEntity=EntrepriseContract::class, mappedBy="Entreprise")
     */
    private $entrepriseContracts;

    /**
     * @ORM\OneToOne(targetEntity=BankAccount::class, cascade={"persist", "remove"})
     */
    private $BankAccount;

    /**
     * @ORM\OneToOne(targetEntity=User::class, mappedBy="entreprise", cascade={"persist", "remove"})
     */
    private $user;

    public function __construct()
    {
        $this->entrepriseContracts = new ArrayCollection();
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

    /**
     * @return Collection|EntrepriseContract[]
     */
    public function getEntrepriseContracts(): Collection
    {
        return $this->entrepriseContracts;
    }

    public function addEntrepriseContract(EntrepriseContract $entrepriseContract): self
    {
        if (!$this->entrepriseContracts->contains($entrepriseContract)) {
            $this->entrepriseContracts[] = $entrepriseContract;
            $entrepriseContract->setEntreprise($this);
        }

        return $this;
    }

    public function removeEntrepriseContract(EntrepriseContract $entrepriseContract): self
    {
        if ($this->entrepriseContracts->removeElement($entrepriseContract)) {
            // set the owning side to null (unless already changed)
            if ($entrepriseContract->getEntreprise() === $this) {
                $entrepriseContract->setEntreprise(null);
            }
        }

        return $this;
    }

    public function getBankAccount(): ?BankAccount
    {
        return $this->BankAccount;
    }

    public function setBankAccount(?BankAccount $BankAccount): self
    {
        $this->BankAccount = $BankAccount;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        // unset the owning side of the relation if necessary
        if ($user === null && $this->user !== null) {
            $this->user->setEntreprise(null);
        }

        // set the owning side of the relation if necessary
        if ($user !== null && $user->getEntreprise() !== $this) {
            $user->setEntreprise($this);
        }

        $this->user = $user;

        return $this;
    }
}
