<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\ManyToMany(targetEntity: Daytime::class, inversedBy: 'menus')]
    private Collection $daytimes;

    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: Setmenu::class)]
    private Collection $setmenus;

    public function __construct()
    {
        $this->daytimes = new ArrayCollection();
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

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return Collection<int, Daytime>
     */
    public function getDaytimes(): Collection
    {
        return $this->daytimes;
    }

    public function addDaytime(Daytime $daytime): self
    {
        if (!$this->daytimes->contains($daytime)) {
            $this->daytimes->add($daytime);
        }

        return $this;
    }

    public function removeDaytime(Daytime $daytime): self
    {
        $this->daytimes->removeElement($daytime);

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
            $setmenu->setMenu($this);
        }

        return $this;
    }

    public function removeSetmenu(Setmenu $setmenu): self
    {
        if ($this->setmenus->removeElement($setmenu)) {
            // set the owning side to null (unless already changed)
            if ($setmenu->getMenu() === $this) {
                $setmenu->setMenu(null);
            }
        }

        return $this;
    }
}
