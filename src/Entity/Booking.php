<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookingRepository::class)]
class Booking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Restaurant $restaurant = null;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;
    //private ?User $users = null;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Openingday $openingday = null;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Openinghour $openinghour = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $bookedAt = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $startAt = null;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Guest $guest = null;

    #[ORM\ManyToMany(targetEntity: Allergy::class, inversedBy: 'bookings')]
    private Collection $allergies;

    #[ORM\Column(nullable: true)]
    private ?int $remainingseats = null;


    public function __construct()
    {
        $this->allergies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

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

//    public function getUsers(): ?User
//    {
//        return $this->users;
//    }

    public function getUser(): ?User
    {
        return $this->user;
    }

//    public function setUsers(?User $users): self
//    {
//        $this->users = $users;
//
//        return $this;
//    }
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getOpeningday(): ?Openingday
    {
        return $this->openingday;
    }

    public function setOpeningday(?Openingday $openingday): self
    {
        $this->openingday = $openingday;

        return $this;
    }

    public function getOpeninghour(): ?Openinghour
    {
        return $this->openinghour;
    }

    public function setOpeninghour(?Openinghour $openinghour): self
    {
        $this->openinghour = $openinghour;

        return $this;
    }

    public function getBookedAt(): ?\DateTimeInterface
    {
        return $this->bookedAt;
    }

    public function setBookedAt(\DateTimeInterface $bookedAt): self
    {
        $this->bookedAt = $bookedAt;

        return $this;
    }

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeInterface $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getGuest(): ?Guest
    {
        return $this->guest;
    }

    public function setGuest(?Guest $guest): self
    {
        $this->guest = $guest;

        return $this;
    }

    /**
     * @return Collection<int, Allergy>
     */
    public function getAllergies(): Collection
    {
        return $this->allergies;
    }

    public function addAllergy(Allergy $allergy): self
    {
        if (!$this->allergies->contains($allergy)) {
            $this->allergies->add($allergy);
        }

        return $this;
    }

    public function removeAllergy(Allergy $allergy): self
    {
        $this->allergies->removeElement($allergy);

        return $this;
    }

    public function getRemainingseats(): ?int
    {
        return $this->remainingseats;
    }

    public function setRemainingseats(?int $remainingseats): self
    {
        $this->remainingseats = $remainingseats;

        return $this;
    }

    /**
     * Put the objet to an array
     * @return array|null
     */
    public function toArray() : ?array
    {
        return [
            "bookedAt" => $this->getBookedAt(),
            "startAt" => $this->getStartAt(),
            "remainingSeats" => $this->getRemainingseats()
        ];
    }

}
