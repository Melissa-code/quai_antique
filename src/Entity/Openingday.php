<?php

namespace App\Entity;

use App\Repository\OpeningdayRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: OpeningdayRepository::class)]
class Openingday
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 3, max: 20, minMessage: 'Le jour doit comporter au minimum {{ limit }} caractères', maxMessage: 'Le jour doit comporter au maximum {{ limit }} caractères')]
    private ?string $day = null;

    #[ORM\Column]
    private ?bool $open = null;

    #[ORM\ManyToOne(inversedBy: 'openingdays')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Restaurant $restaurant = null;

    #[ORM\ManyToMany(targetEntity: Openinghour::class, mappedBy: 'openingdays')]
    private Collection $openinghours;

    #[ORM\OneToMany(mappedBy: 'openingday', targetEntity: Booking::class)]
    private Collection $bookings;

    public function __construct()
    {
        $this->openinghours = new ArrayCollection();
        $this->bookings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function isOpen(): ?bool
    {
        return $this->open;
    }

    public function setOpen(bool $open): self
    {
        $this->open = $open;

        return $this;
    }

    public function getRestaurant(): ?Restaurant
    {
        return $this->restaurant;
    }

    public function setRestaurant(?Restaurant $restaurant): self
    {
        $this->restaurant = $restaurant;

        return $this;
    }

    /**
     * @return Collection<int, Openinghour>
     */
    public function getOpeninghours(): Collection
    {
        return $this->openinghours;
    }

    public function addOpeninghour(Openinghour $openinghour): self
    {
        if (!$this->openinghours->contains($openinghour)) {
            $this->openinghours->add($openinghour);
            $openinghour->addOpeningday($this);
        }

        return $this;
    }

    public function removeOpeninghour(Openinghour $openinghour): self
    {
        if ($this->openinghours->removeElement($openinghour)) {
            $openinghour->removeOpeningday($this);
        }

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
            $booking->setOpeningday($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getOpeningday() === $this) {
                $booking->setOpeningday(null);
            }
        }

        return $this;
    }



}
