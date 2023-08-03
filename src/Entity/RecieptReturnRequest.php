<?php

namespace App\Entity;

use App\Repository\RecieptReturnRequestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
#[UniqueEntity('startNumber')]
#[UniqueEntity('endNumber')]
#[ORM\Entity(repositoryClass: RecieptReturnRequestRepository::class)]
class RecieptReturnRequest extends CommonEntity
{
    

    #[ORM\ManyToOne(inversedBy: 'recieptReturnRequests')]
    #[ORM\JoinColumn(nullable: false)]
    private ?RecieptIssueRequest $receiptIssueRequest = null;

    #[ORM\Column]
    private ?int $startNumber = null;

    #[ORM\Column]
    private ?int $endNumber = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private ?array $exceptional = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $requestedAt = null;

    #[ORM\ManyToOne(inversedBy: 'recieptReturnRequests')]
    private ?User $requestedBy = null;

    #[ORM\Column(nullable: true)]
    private ?float $totalPrice = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $document = null;

    #[ORM\ManyToOne(inversedBy: 'returnApprovedBy')]
    private ?User $approvedBy = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $approvedAt = null;

    #[ORM\ManyToOne(inversedBy: 'returnReceivedBy')]
    private ?User $recievedBy = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $recievedAt = null;

    #[ORM\OneToMany(mappedBy: 'recieptReturnRequest', targetEntity: RecieptStatus::class)]
    private Collection $recieptStatuses;

    public function __construct()
    {
        $this->recieptStatuses = new ArrayCollection();
    }

    

    public function getReceiptIssueRequest(): ?RecieptIssueRequest
    {
        return $this->receiptIssueRequest;
    }

    public function setReceiptIssueRequest(?RecieptIssueRequest $receiptIssueRequest): static
    {
        $this->receiptIssueRequest = $receiptIssueRequest;

        return $this;
    }

    public function getStartNumber(): ?int
    {
        return $this->startNumber;
    }

    public function setStartNumber(int $startNumber): static
    {
        $this->startNumber = $startNumber;

        return $this;
    }

    public function getEndNumber(): ?int
    {
        return $this->endNumber;
    }

    public function setEndNumber(int $endNumber): static
    {
        $this->endNumber = $endNumber;

        return $this;
    }

    public function getExceptional(): ?array
    {
        return $this->exceptional;
    }

    public function setExceptional(?array $exceptional): static
    {
        $this->exceptional = $exceptional;

        return $this;
    }

    public function getRequestedAt(): ?\DateTimeInterface
    {
        return $this->requestedAt;
    }

    public function setRequestedAt(\DateTimeInterface $requestedAt): static
    {
        $this->requestedAt = $requestedAt;

        return $this;
    }

    public function getRequestedBy(): ?User
    {
        return $this->requestedBy;
    }

    public function setRequestedBy(?User $requestedBy): static
    {
        $this->requestedBy = $requestedBy;

        return $this;
    }

    public function getTotalPrice(): ?float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(?float $totalPrice): static
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function getDocument(): ?string
    {
        return $this->document;
    }

    public function setDocument(?string $document): static
    {
        $this->document = $document;

        return $this;
    }

    public function getApprovedBy(): ?User
    {
        return $this->approvedBy;
    }

    public function setApprovedBy(?User $approvedBy): static
    {
        $this->approvedBy = $approvedBy;

        return $this;
    }

    public function getApprovedAt(): ?\DateTimeInterface
    {
        return $this->approvedAt;
    }

    public function setApprovedAt(?\DateTimeInterface $approvedAt): static
    {
        $this->approvedAt = $approvedAt;

        return $this;
    }

    public function getRecievedBy(): ?User
    {
        return $this->recievedBy;
    }

    public function setRecievedBy(?User $recievedBy): static
    {
        $this->recievedBy = $recievedBy;

        return $this;
    }

    public function getRecievedAt(): ?\DateTimeInterface
    {
        return $this->recievedAt;
    }

    public function setRecievedAt(?\DateTimeInterface $recievedAt): static
    {
        $this->recievedAt = $recievedAt;

        return $this;
    }

    /**
     * @return Collection<int, RecieptStatus>
     */
    public function getRecieptStatuses(): Collection
    {
        return $this->recieptStatuses;
    }

    public function addRecieptStatus(RecieptStatus $recieptStatus): static
    {
        if (!$this->recieptStatuses->contains($recieptStatus)) {
            $this->recieptStatuses->add($recieptStatus);
            $recieptStatus->setRecieptReturnRequest($this);
        }

        return $this;
    }

    public function removeRecieptStatus(RecieptStatus $recieptStatus): static
    {
        if ($this->recieptStatuses->removeElement($recieptStatus)) {
            // set the owning side to null (unless already changed)
            if ($recieptStatus->getRecieptReturnRequest() === $this) {
                $recieptStatus->setRecieptReturnRequest(null);
            }
        }

        return $this;
    }
}
