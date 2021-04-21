<?php

namespace App\Entity;

use App\Repository\BankTransactionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BankTransactionRepository::class)
 */
class BankTransaction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $amount;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datetame;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $info;

    /**
     * @ORM\ManyToOne(targetEntity=BankAccount::class, inversedBy="BankTransaction")
     */
    private $bankAccount;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getDatetame(): ?\DateTimeInterface
    {
        return $this->datetame;
    }

    public function setDatetame(\DateTimeInterface $datetame): self
    {
        $this->datetame = $datetame;

        return $this;
    }

    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function setInfo(?string $info): self
    {
        $this->info = $info;

        return $this;
    }

    public function getBankAccount(): ?BankAccount
    {
        return $this->bankAccount;
    }

    public function setBankAccount(?BankAccount $bankAccount): self
    {
        $this->bankAccount = $bankAccount;

        return $this;
    }
}
