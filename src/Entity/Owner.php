<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OwnerRepository")
 */
class Owner extends User
{
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Accommodation", mappedBy="owner")
     */
    private $accomodations;

    public function __construct()
    {
        $this->accomodations = new ArrayCollection();
    }

    /**
     * @return Collection|Accommodation[]
     */
    public function getAccomodations(): Collection
    {
        return $this->accomodations;
    }

    public function addAccomodation(Accommodation $accomodation): self
    {
        if (!$this->accomodations->contains($accomodation)) {
            $this->accomodations[] = $accomodation;
            $accomodation->setOwner($this);
        }

        return $this;
    }

    public function removeAccomodation(Accommodation $accomodation): self
    {
        if ($this->accomodations->contains($accomodation)) {
            $this->accomodations->removeElement($accomodation);
            // set the owning side to null (unless already changed)
            if ($accomodation->getOwner() === $this) {
                $accomodation->setOwner(null);
            }
        }

        return $this;
    }
}
