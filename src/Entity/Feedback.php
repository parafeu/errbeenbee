<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FeedbackRepository")
 */
class Feedback
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Booking", mappedBy="feedback", cascade={"persist", "remove"})
     */
    private $booking;

    /**
     * @ORM\Column(type="integer")
     */
    private $stars;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBooking(): ?Booking
    {
        return $this->booking;
    }

    public function setBooking(?Booking $booking): self
    {
        $this->booking = $booking;

        // set (or unset) the owning side of the relation if necessary
        $newFeedback = $booking === null ? null : $this;
        if ($newFeedback !== $booking->getFeedback()) {
            $booking->setFeedback($newFeedback);
        }

        return $this;
    }

    public function getStars(): ?int
    {
        return $this->stars;
    }

    public function setStars(int $stars): self
    {
        $this->stars = $stars;

        return $this;
    }
}
