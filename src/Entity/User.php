<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
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
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $password;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $voteQuantity;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $voteLastDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $booster;

    /**
     * @ORM\ManyToOne(targetEntity=Grade::class, inversedBy="users")
     */
    private $Grade;

    /**
     * @ORM\OneToMany(targetEntity=Land::class, mappedBy="User")
     */
    private $lands;

    /**
     * @ORM\OneToOne(targetEntity=BankAccount::class, cascade={"persist", "remove"})
     */
    private $BankAcount;

    /**
     * @ORM\OneToMany(targetEntity=EntrepriseContract::class, mappedBy="user")
     */
    private $EntrepriseContracts;

    /**
     * @ORM\OneToOne(targetEntity=Entreprise::class, inversedBy="user", cascade={"persist", "remove"})
     */
    private $entreprise;

    /**
     * @ORM\ManyToMany(targetEntity=Land::class, mappedBy="UserAutorisation")
     */
    private $LandsAutorisations;

    public function __construct()
    {
        $this->lands = new ArrayCollection();
        $this->EntrepriseContracts = new ArrayCollection();
        $this->LandsAutorisations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getVoteQuantity(): ?int
    {
        return $this->voteQuantity;
    }

    public function setVoteQuantity(?int $voteQuantity): self
    {
        $this->voteQuantity = $voteQuantity;

        return $this;
    }

    public function getVoteLastDate(): ?\DateTimeInterface
    {
        return $this->voteLastDate;
    }

    public function setVoteLastDate(?\DateTimeInterface $voteLastDate): self
    {
        $this->voteLastDate = $voteLastDate;

        return $this;
    }

    public function getBooster(): ?string
    {
        return $this->booster;
    }

    public function setBooster(?string $booster): self
    {
        $this->booster = $booster;

        return $this;
    }

    public function getGrade(): ?Grade
    {
        return $this->Grade;
    }

    public function setGrade(?Grade $Grade): self
    {
        $this->Grade = $Grade;

        return $this;
    }

    /**
     * @return Collection|Land[]
     */
    public function getLands(): Collection
    {
        return $this->lands;
    }

    public function addLand(Land $land): self
    {
        if (!$this->lands->contains($land)) {
            $this->lands[] = $land;
            $land->setUser($this);
        }

        return $this;
    }

    public function removeLand(Land $land): self
    {
        if ($this->lands->removeElement($land)) {
            // set the owning side to null (unless already changed)
            if ($land->getUser() === $this) {
                $land->setUser(null);
            }
        }

        return $this;
    }

    public function getBankAcount(): ?BankAccount
    {
        return $this->BankAcount;
    }

    public function setBankAcount(?BankAccount $BankAcount): self
    {
        $this->BankAcount = $BankAcount;

        return $this;
    }

    /**
     * @return Collection|EntrepriseContract[]
     */
    public function getEntrepriseContracts(): Collection
    {
        return $this->EntrepriseContracts;
    }

    public function addEntrepriseContract(EntrepriseContract $entrepriseContract): self
    {
        if (!$this->EntrepriseContracts->contains($entrepriseContract)) {
            $this->EntrepriseContracts[] = $entrepriseContract;
            $entrepriseContract->setUser($this);
        }

        return $this;
    }

    public function removeEntrepriseContract(EntrepriseContract $entrepriseContract): self
    {
        if ($this->EntrepriseContracts->removeElement($entrepriseContract)) {
            // set the owning side to null (unless already changed)
            if ($entrepriseContract->getUser() === $this) {
                $entrepriseContract->setUser(null);
            }
        }

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    /**
     * @return Collection|Land[]
     */
    public function getLandsAutorisations(): Collection
    {
        return $this->LandsAutorisations;
    }

    public function addLandsAutorisation(Land $landsAutorisation): self
    {
        if (!$this->LandsAutorisations->contains($landsAutorisation)) {
            $this->LandsAutorisations[] = $landsAutorisation;
            $landsAutorisation->addUserAutorisation($this);
        }

        return $this;
    }

    public function removeLandsAutorisation(Land $landsAutorisation): self
    {
        if ($this->LandsAutorisations->removeElement($landsAutorisation)) {
            $landsAutorisation->removeUserAutorisation($this);
        }

        return $this;
    }
}
