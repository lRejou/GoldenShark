<?php

namespace App\Entity;

use App\Repository\LandRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LandRepository::class)
 */
class Land
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
    private $landId;

    /**
     * @ORM\Column(type="boolean")
     */
    private $mobSpawn;

    /**
     * @ORM\Column(type="boolean")
     */
    private $tnt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $fire;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="lands")
     */
    private $User;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLandId(): ?string
    {
        return $this->landId;
    }

    public function setLandId(string $landId): self
    {
        $this->landId = $landId;

        return $this;
    }

    public function getMobSpawn(): ?bool
    {
        return $this->mobSpawn;
    }

    public function setMobSpawn(bool $mobSpawn): self
    {
        $this->mobSpawn = $mobSpawn;

        return $this;
    }

    public function getTnt(): ?bool
    {
        return $this->tnt;
    }

    public function setTnt(bool $tnt): self
    {
        $this->tnt = $tnt;

        return $this;
    }

    public function getFire(): ?bool
    {
        return $this->fire;
    }

    public function setFire(bool $fire): self
    {
        $this->fire = $fire;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }
}
