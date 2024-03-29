<?php

namespace App\Entity;

use App\Repository\BankAccountRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BankAccountRepository::class)
 */
class BankAccount
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
    private $money;

    /**
     * @ORM\OneToMany(targetEntity=BankTransaction::class, mappedBy="bankAccount")
     */
    private $BankTransaction;

    /**
     * @ORM\OneToMany(targetEntity=BankAccountStats::class, mappedBy="bankAccount")
     */
    private $bankAccountStats;

    public function __construct()
    {
        $this->BankTransaction = new ArrayCollection();
        $this->bankAccountStats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMoney(): ?int
    {
        return $this->money;
    }

    public function setMoney(?int $money): self
    {
        $this->money = $money;

        return $this;
    }

    /**
     * @return Collection|BankTransaction[]
     */
    public function getBankTransaction(): Collection
    {
        return $this->BankTransaction;
    }

    public function addBankTransaction(BankTransaction $bankTransaction): self
    {
        if (!$this->BankTransaction->contains($bankTransaction)) {
            $this->BankTransaction[] = $bankTransaction;
            $bankTransaction->setBankAccount($this);
        }

        return $this;
    }

    public function removeBankTransaction(BankTransaction $bankTransaction): self
    {
        if ($this->BankTransaction->removeElement($bankTransaction)) {
            // set the owning side to null (unless already changed)
            if ($bankTransaction->getBankAccount() === $this) {
                $bankTransaction->setBankAccount(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|BankAccountStats[]
     */
    public function getBankAccountStats(): Collection
    {
        return $this->bankAccountStats;
    }

    public function addBankAccountStat(BankAccountStats $bankAccountStat): self
    {
        if (!$this->bankAccountStats->contains($bankAccountStat)) {
            $this->bankAccountStats[] = $bankAccountStat;
            $bankAccountStat->setBankAccount($this);
        }

        return $this;
    }

    public function removeBankAccountStat(BankAccountStats $bankAccountStat): self
    {
        if ($this->bankAccountStats->removeElement($bankAccountStat)) {
            // set the owning side to null (unless already changed)
            if ($bankAccountStat->getBankAccount() === $this) {
                $bankAccountStat->setBankAccount(null);
            }
        }

        return $this;
    }
}
