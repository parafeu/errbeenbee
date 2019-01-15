<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoomRepository")
 */
class Room
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sharedRoom;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sharedKitchen;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sharedBathroom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSharedRoom(): ?bool
    {
        return $this->sharedRoom;
    }

    public function setSharedRoom(bool $sharedRoom): self
    {
        $this->sharedRoom = $sharedRoom;

        return $this;
    }

    public function getSharedKitchen(): ?bool
    {
        return $this->sharedKitchen;
    }

    public function setSharedKitchen(bool $sharedKitchen): self
    {
        $this->sharedKitchen = $sharedKitchen;

        return $this;
    }

    public function getSharedBathroom(): ?bool
    {
        return $this->sharedBathroom;
    }

    public function setSharedBathroom(bool $sharedBathroom): self
    {
        $this->sharedBathroom = $sharedBathroom;

        return $this;
    }
}
