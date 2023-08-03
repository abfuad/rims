<?php

namespace App\Entity;

use App\Repository\RecieptGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
#[UniqueEntity('startNumber')]
#[UniqueEntity('endNumber')]
#[ORM\Entity(repositoryClass: RecieptGroupRepository::class)]
class RecieptGroup extends CommonEntity
{
   

    #[ORM\Column]
    private ?int $startNumber = null;

    #[ORM\Column]
    private ?int $endNumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $document = null;

    #[ORM\OneToMany(mappedBy: 'recieptGroup', targetEntity: Reciept::class, orphanRemoval: true)]
    private Collection $reciepts;

    public function __construct()
    {
        $this->reciepts = new ArrayCollection();
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

    public function getDocument(): ?string
    {
        return $this->document;
    }

    public function setDocument(?string $document): static
    {
        $this->document = $document;

        return $this;
    }

    /**
     * @return Collection<int, Reciept>
     */
    public function getReciepts(): Collection
    {
        return $this->reciepts;
    }

    public function addReciept(Reciept $reciept): static
    {
        if (!$this->reciepts->contains($reciept)) {
            $this->reciepts->add($reciept);
            $reciept->setRecieptGroup($this);
        }

        return $this;
    }

    public function removeReciept(Reciept $reciept): static
    {
        if ($this->reciepts->removeElement($reciept)) {
            // set the owning side to null (unless already changed)
            if ($reciept->getRecieptGroup() === $this) {
                $reciept->setRecieptGroup(null);
            }
        }

        return $this;
    }
}
