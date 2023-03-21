<?php

namespace App\Entity;

use App\Repository\OpeninghourRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OpeninghourRepository::class)]
class Openinghour
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    #[Assert\NotBlank(allowNull : false)]
    private ?\DateTimeInterface $starthour = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    #[Assert\NotBlank(allowNull : false)]
    private ?\DateTimeInterface $endhour = null;

    #[ORM\ManyToMany(targetEntity: Openingday::class, inversedBy: 'openinghours')]
    private Collection $openingdays;

    #[ORM\OneToMany(mappedBy: 'openinghour', targetEntity: Booking::class)]
    private Collection $bookings;

    public function __construct()
    {
        $this->openingdays = new ArrayCollection();
        $this->bookings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStarthour(): ?\DateTimeInterface
    {
        return $this->starthour;
    }

    public function setStarthour(\DateTimeInterface $starthour): self
    {
        $this->starthour = $starthour;

        return $this;
    }

    public function getEndhour(): ?\DateTimeInterface
    {
        return $this->endhour;
    }

    public function setEndhour(\DateTimeInterface $endhour): self
    {
        $this->endhour = $endhour;

        return $this;
    }

    /**
     * @return Collection<int, Openingday>
     */
    public function getOpeningdays(): Collection
    {
        return $this->openingdays;
    }

    public function addOpeningday(Openingday $openingday): self
    {
        if (!$this->openingdays->contains($openingday)) {
            $this->openingdays->add($openingday);
        }

        return $this;
    }

    public function removeOpeningday(Openingday $openingday): self
    {
        $this->openingdays->removeElement($openingday);

        return $this;
    }

    /**
     * @return Collection<int, Booking>
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings->add($booking);
            $booking->setOpeninghour($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getOpeninghour() === $this) {
                $booking->setOpeninghour(null);
            }
        }

        return $this;
    }


    /**
     * Display the id, the start hour and the end hour
     * @return string
     */
    public function __toString() : string {
        $id = $this->getId();
        $starthour = $this->getStarthour()->format('H:i');
        $endhour = $this->getEndhour()->format('H:i');
        return sprintf("%s : %s - %s", $id, $starthour, $endhour);
    }


}
