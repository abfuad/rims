<?php

namespace App\Entity;

use App\Repository\OfficeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OfficeRepository::class)]
class Office extends CommonEntity
{
    #[ORM\OneToMany(mappedBy: 'office', targetEntity: UserInfo::class)]
    private Collection $userInfos;

    #[ORM\OneToMany(mappedBy: 'office', targetEntity: RecieptIssueRequest::class)]
    private Collection $recieptIssueRequests;

    public function __construct()
    {
        $this->userInfos = new ArrayCollection();
        $this->recieptIssueRequests = new ArrayCollection();
    }

    /**
     * @return Collection<int, UserInfo>
     */
    public function getUserInfos(): Collection
    {
        return $this->userInfos;
    }

    public function addUserInfo(UserInfo $userInfo): static
    {
        if (!$this->userInfos->contains($userInfo)) {
            $this->userInfos->add($userInfo);
            $userInfo->setOffice($this);
        }

        return $this;
    }

    public function removeUserInfo(UserInfo $userInfo): static
    {
        if ($this->userInfos->removeElement($userInfo)) {
            // set the owning side to null (unless already changed)
            if ($userInfo->getOffice() === $this) {
                $userInfo->setOffice(null);
            }
        }

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
            $recieptIssueRequest->setOffice($this);
        }

        return $this;
    }

    public function removeRecieptIssueRequest(RecieptIssueRequest $recieptIssueRequest): static
    {
        if ($this->recieptIssueRequests->removeElement($recieptIssueRequest)) {
            // set the owning side to null (unless already changed)
            if ($recieptIssueRequest->getOffice() === $this) {
                $recieptIssueRequest->setOffice(null);
            }
        }

        return $this;
    }
}
