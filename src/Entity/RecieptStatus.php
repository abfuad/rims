<?php

namespace App\Entity;

use App\Repository\RecieptStatusRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecieptStatusRepository::class)]
class RecieptStatus extends BaseEntity
{
  

    #[ORM\OneToOne(inversedBy: 'status', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Reciept $receipt = null;

    #[ORM\ManyToOne(inversedBy: 'recieptStatuses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?RecieptIssueRequest $recieptIssueRequest = null;

    #[ORM\ManyToOne(inversedBy: 'recieptStatuses')]
    private ?RecieptReturnRequest $recieptReturnRequest = null;

    #[ORM\Column]
    private ?int $status = null;

    #[ORM\Column(nullable: true)]
    private ?float $cost = null;

    public function getReceipt(): ?Reciept
    {
        return $this->receipt;
    }

    public function setReceipt(Reciept $receipt): static
    {
        $this->receipt = $receipt;

        return $this;
    }

    public function getRecieptIssueRequest(): ?RecieptIssueRequest
    {
        return $this->recieptIssueRequest;
    }

    public function setRecieptIssueRequest(?RecieptIssueRequest $recieptIssueRequest): static
    {
        $this->recieptIssueRequest = $recieptIssueRequest;

        return $this;
    }

    public function getRecieptReturnRequest(): ?RecieptReturnRequest
    {
        return $this->recieptReturnRequest;
    }

    public function setRecieptReturnRequest(?RecieptReturnRequest $recieptReturnRequest): static
    {
        $this->recieptReturnRequest = $recieptReturnRequest;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getCost(): ?float
    {
        return $this->cost;
    }

    public function setCost(?float $cost): static
    {
        $this->cost = $cost;

        return $this;
    }
}
