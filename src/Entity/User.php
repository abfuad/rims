<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User  extends BaseEntity implements UserInterface, PasswordAuthenticatedUserInterface
{
    

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;
    #[ORM\Column]
    private ?bool $isActive = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?UserInfo $userInfo = null;

    #[ORM\OneToMany(mappedBy: 'approvedBy', targetEntity: RecieptIssueRequest::class)]
    private Collection $recieptIssueRequests;

    #[ORM\OneToMany(mappedBy: 'givenBy', targetEntity: RecieptIssueRequest::class)]
    private Collection $issuedBy;

    #[ORM\OneToMany(mappedBy: 'recievedBy', targetEntity: RecieptIssueRequest::class)]
    private Collection $recievedBy;

    #[ORM\OneToMany(mappedBy: 'requestedBy', targetEntity: RecieptReturnRequest::class)]
    private Collection $recieptReturnRequests;

    #[ORM\OneToMany(mappedBy: 'approvedBy', targetEntity: RecieptReturnRequest::class)]
    private Collection $returnApprovedBy;

    #[ORM\OneToMany(mappedBy: 'recievedBy', targetEntity: RecieptReturnRequest::class)]
    private Collection $returnReceivedBy;

    #[ORM\ManyToMany(targetEntity: UserGroup::class, mappedBy: 'users')]
    private Collection $userGroups;

    public function __construct()
    {
        $this->recieptIssueRequests = new ArrayCollection();
        $this->issuedBy = new ArrayCollection();
        $this->recievedBy = new ArrayCollection();
        $this->recieptReturnRequests = new ArrayCollection();
        $this->returnApprovedBy = new ArrayCollection();
        $this->returnReceivedBy = new ArrayCollection();
        $this->userGroups = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->userInfo->getFullName();
    
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }
    public function isIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUserInfo(): ?UserInfo
    {
        return $this->userInfo;
    }

    public function setUserInfo(UserInfo $userInfo): static
    {
        // set the owning side of the relation if necessary
        if ($userInfo->getUser() !== $this) {
            $userInfo->setUser($this);
        }

        $this->userInfo = $userInfo;

        return $this;
    }

    /**
     * @return Collection<int, RecieptIssueRequest>
     */
    public function getRecieptIssueRequests(): Collection
    {
        return $this->recieptIssueRequests;
    }

    public function addRecieptIssueRequest(RecieptIssueRequest $recieptIssueRequest): static
    {
        if (!$this->recieptIssueRequests->contains($recieptIssueRequest)) {
            $this->recieptIssueRequests->add($recieptIssueRequest);
            $recieptIssueRequest->setApprovedBy($this);
        }

        return $this;
    }

    public function removeRecieptIssueRequest(RecieptIssueRequest $recieptIssueRequest): static
    {
        if ($this->recieptIssueRequests->removeElement($recieptIssueRequest)) {
            // set the owning side to null (unless already changed)
            if ($recieptIssueRequest->getApprovedBy() === $this) {
                $recieptIssueRequest->setApprovedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RecieptIssueRequest>
     */
    public function getIssuedBy(): Collection
    {
        return $this->issuedBy;
    }

    public function addIssuedBy(RecieptIssueRequest $issuedBy): static
    {
        if (!$this->issuedBy->contains($issuedBy)) {
            $this->issuedBy->add($issuedBy);
            $issuedBy->setGivenBy($this);
        }

        return $this;
    }

    public function removeIssuedBy(RecieptIssueRequest $issuedBy): static
    {
        if ($this->issuedBy->removeElement($issuedBy)) {
            // set the owning side to null (unless already changed)
            if ($issuedBy->getGivenBy() === $this) {
                $issuedBy->setGivenBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RecieptIssueRequest>
     */
    public function getRecievedBy(): Collection
    {
        return $this->recievedBy;
    }

    public function addRecievedBy(RecieptIssueRequest $recievedBy): static
    {
        if (!$this->recievedBy->contains($recievedBy)) {
            $this->recievedBy->add($recievedBy);
            $recievedBy->setRecievedBy($this);
        }

        return $this;
    }

    public function removeRecievedBy(RecieptIssueRequest $recievedBy): static
    {
        if ($this->recievedBy->removeElement($recievedBy)) {
            // set the owning side to null (unless already changed)
            if ($recievedBy->getRecievedBy() === $this) {
                $recievedBy->setRecievedBy(null);
            }
        }

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
            $recieptReturnRequest->setRequestedBy($this);
        }

        return $this;
    }

    public function removeRecieptReturnRequest(RecieptReturnRequest $recieptReturnRequest): static
    {
        if ($this->recieptReturnRequests->removeElement($recieptReturnRequest)) {
            // set the owning side to null (unless already changed)
            if ($recieptReturnRequest->getRequestedBy() === $this) {
                $recieptReturnRequest->setRequestedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RecieptReturnRequest>
     */
    public function getReturnApprovedBy(): Collection
    {
        return $this->returnApprovedBy;
    }

    public function addReturnApprovedBy(RecieptReturnRequest $returnApprovedBy): static
    {
        if (!$this->returnApprovedBy->contains($returnApprovedBy)) {
            $this->returnApprovedBy->add($returnApprovedBy);
            $returnApprovedBy->setApprovedBy($this);
        }

        return $this;
    }

    public function removeReturnApprovedBy(RecieptReturnRequest $returnApprovedBy): static
    {
        if ($this->returnApprovedBy->removeElement($returnApprovedBy)) {
            // set the owning side to null (unless already changed)
            if ($returnApprovedBy->getApprovedBy() === $this) {
                $returnApprovedBy->setApprovedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, RecieptReturnRequest>
     */
    public function getReturnReceivedBy(): Collection
    {
        return $this->returnReceivedBy;
    }

    public function addReturnReceivedBy(RecieptReturnRequest $returnReceivedBy): static
    {
        if (!$this->returnReceivedBy->contains($returnReceivedBy)) {
            $this->returnReceivedBy->add($returnReceivedBy);
            $returnReceivedBy->setRecievedBy($this);
        }

        return $this;
    }

    public function removeReturnReceivedBy(RecieptReturnRequest $returnReceivedBy): static
    {
        if ($this->returnReceivedBy->removeElement($returnReceivedBy)) {
            // set the owning side to null (unless already changed)
            if ($returnReceivedBy->getRecievedBy() === $this) {
                $returnReceivedBy->setRecievedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserGroup>
     */
    public function getUserGroups(): Collection
    {
        return $this->userGroups;
    }

    public function addUserGroup(UserGroup $userGroup): static
    {
        if (!$this->userGroups->contains($userGroup)) {
            $this->userGroups->add($userGroup);
            $userGroup->addUser($this);
        }

        return $this;
    }

    public function removeUserGroup(UserGroup $userGroup): static
    {
        if ($this->userGroups->removeElement($userGroup)) {
            $userGroup->removeUser($this);
        }

        return $this;
    }
}
