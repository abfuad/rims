<?php

namespace App\Entity;

use App\Repository\RecieptIssueRequestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
#[UniqueEntity('startNumber')]
#[UniqueEntity('endNumber')]
#[ORM\Entity(repositoryClass: RecieptIssueRequestRepository::class)]
class RecieptIssueRequest extends CommonEntity
{
  

    #[ORM\ManyToOne(inversedBy: 'recieptIssueRequests')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Office $office = null;

    #[ORM\Column]
    private ?int $startNumber = null;

    #[ORM\Column]
    private ?int $endNumber = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    private ?array $exceptional = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $requestDocument = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $requestedAt = null;

    #[ORM\ManyToOne(inversedBy: 'recieptIssueRequests')]
    private ?User $approvedBy = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $approvedAt = null;

    #[ORM\ManyToOne(inversedBy: 'issuedBy')]
    private ?User $givenBy = null;

    #[ORM\ManyToOne(inversedBy: 'recievedBy')]
    private ?User $recievedBy = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $recievedAt = null;

    #[ORM\OneToMany(mappedBy: 'receiptIssueRequest', targetEntity: RecieptReturnRequest::class)]
    private Collection $recieptReturnRequests;

    #[ORM\OneToMany(mappedBy: 'recieptIssueRequest', targetEntity: RecieptStatus::class)]
    private Collection $recieptStatuses;

    public function __construct()
    {
        $this->recieptReturnRequests = new ArrayCollection();
        $this->recieptStatuses = new ArrayCollection();
    }

  
    

    public function getOffice(): ?Office
    {
        return $this->office;
    }

    public function setOffice(?Office $office): static
    {
        $this->office = $office;

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

    public function getRequestDocument(): ?string
    {
        return $this->requestDocument;
    }

    public function setRequestDocument(?string $requestDocument): static
    {
        $this->requestDocument = $requestDocument;

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

    

    public function getGivenBy(): ?User
    {
        return $this->givenBy;
    }

    public function setGivenBy(?User $givenBy): static
    {
        $this->givenBy = $givenBy;

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
     * @return Collection<int, RecieptReturnRequest>
     */
    public function getRecieptReturnRequests(): Collection
    {
        return $this->recieptReturnRequests;
    }

    public function addRecieptReturnRequest(RecieptReturnRequest $recieptReturnRequest): static
    {
        if (!$this->recieptReturnRequests->contains($recieptReturnRequest)) {
            $this->recieptReturnRequests->add($recieptReturnRequest);
            $recieptReturnRequest->setReceiptIssueRequest($this);
        }

        return $this;
    }

    public function removeRecieptReturnRequest(RecieptReturnRequest $recieptReturnRequest): static
    {
        if ($this->recieptReturnRequests->removeElement($recieptReturnRequest)) {
            // set the owning side to null (unless already changed)
            if ($recieptReturnRequest->getReceiptIssueRequest() === $this) {
                $recieptReturnRequest->setReceiptIssueRequest(null);
            }
        }

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
            $recieptStatus->setRecieptIssueRequest($this);
        }

        return $this;
    }

    public function removeRecieptStatus(RecieptStatus $recieptStatus): static
    {
        if ($this->recieptStatuses->removeElement($recieptStatus)) {
            // set the owning side to null (unless already changed)
            if ($recieptStatus->getRecieptIssueRequest() === $this) {
                $recieptStatus->setRecieptIssueRequest(null);
            }
        }

        return $this;
    }

    
}
