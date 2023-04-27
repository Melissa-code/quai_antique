<?php

namespace App\Entity;

use App\Repository\DishRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


#[ORM\Entity(repositoryClass: DishRepository::class)]
#[UniqueEntity(fields:['title'], message: "This dish already exists.")]
class Dish
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique:true)]
    #[Assert\Length(min: 3, max: 50, minMessage: 'The title must be at least {{ limit }} characters long', maxMessage: 'The title cannot be longer than {{ limit }} characters',)]
    private ?string $title = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    #[Assert\Range(notInRangeMessage: 'This value should be between {{ min }} and {{ max }}', min: 0.1, max: 2000,)]
    private ?string $price = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\Length(min: 3, max: 255, minMessage: 'La description doit comporter au minimum {{ limit }} caractères', maxMessage: 'La description doit comporter au maximum {{ limit }} caractères',)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    // Attribute not mapped to the datatabase
    private ?File $imageFile = null;

    #[ORM\Column]
    #[Assert\NotBlank(allowNull : false)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    #[Assert\NotNull]
    private ?bool $favorite = null;

    #[ORM\Column]
    #[Assert\NotNull]
    private ?bool $active = null;

    #[ORM\ManyToOne(inversedBy: 'dishes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Restaurant $restaurant = null;

    #[ORM\ManyToOne(inversedBy: 'dishes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\ManyToMany(targetEntity: Setmenu::class, mappedBy: 'dishes')]
    private Collection $setmenus;

    public function __construct()
    {
        $this->setmenus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile): self
    {
        $this->imageFile = $imageFile;

        return $this;
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

    public function isFavorite(): ?bool
    {
        return $this->favorite;
    }

    public function setFavorite(bool $favorite): self
    {
        $this->favorite = $favorite;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Setmenu>
     */
    public function getSetmenus(): Collection
    {
        return $this->setmenus;
    }

    public function addSetmenu(Setmenu $setmenu): self
    {
        if (!$this->setmenus->contains($setmenu)) {
            $this->setmenus->add($setmenu);
            $setmenu->addDish($this);
        }

        return $this;
    }

    public function removeSetmenu(Setmenu $setmenu): self
    {
        if ($this->setmenus->removeElement($setmenu)) {
            $setmenu->removeDish($this);
        }

        return $this;
    }
}
