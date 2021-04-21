<?php

namespace App\Entity;

use App\Repository\EntrepriseContractRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntrepriseContractRepository::class)
 */
class EntrepriseContract
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $salaire;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $accepted;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="EntrepriseContracts")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="entrepriseContracts")
     */
    private $Entreprise;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSalaire(): ?int
    {
        return $this->salaire;
    }

    public function setSalaire(?int $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getAccepted(): ?bool
    {
        return $this->accepted;
    }

    public function setAccepted(?bool $accepted): self
    {
        $this->accepted = $accepted;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->Entreprise;
    }

    public function setEntreprise(?Entreprise $Entreprise): self
    {
        $this->Entreprise = $Entreprise;

        return $this;
    }
}
