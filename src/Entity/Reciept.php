<?php

namespace App\Entity;

use App\Repository\RecieptRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
#[UniqueEntity('recieptNumber')]
#[ORM\Entity(repositoryClass: RecieptRepository::class)]
class Reciept extends BaseEntity
{
    
    #[ORM\ManyToOne(inversedBy: 'reciepts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?RecieptGroup $recieptGroup = null;

    #[ORM\Column]
    private ?int $recieptNumber = null;

    #[ORM\OneToOne(mappedBy: 'receipt', cascade: ['persist', 'remove'])]
    private ?RecieptStatus $status = null;

   
    public function getRecieptGroup(): ?RecieptGroup
    {
        return $this->recieptGroup;
    }

    public function setRecieptGroup(?RecieptGroup $recieptGroup): static
    {
        $this->recieptGroup = $recieptGroup;

        return $this;
    }

    public function getRecieptNumber(): ?int
    {
        return $this->recieptNumber;
    }

    public function setRecieptNumber(int $recieptNumber): static
    {
        $this->recieptNumber = $recieptNumber;

        return $this;
    }

    public function getStatus(): ?RecieptStatus
    {
        return $this->status;
    }

    public function setStatus(RecieptStatus $status): static
    {
        // set the owning side of the relation if necessary
        if ($status->getReceipt() !== $this) {
            $status->setReceipt($this);
        }

        $this->status = $status;

        return $this;
    }
}
