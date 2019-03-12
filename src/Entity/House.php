<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HouseRepository")
 */
class House extends Accommodation
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /** @var int */
    private $nbVisites;

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return int
     */
    public function getNbVisites(): int
    {
        return $this->nbVisites;
    }

    /**
     * @param int $nbVisites
     */
    public function setNbVisites(int $nbVisites): void
    {
        $this->nbVisites = $nbVisites;
    }

    public function __construct()
    {
        parent::__construct();
        $this->nbVisites = 0;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
