<?php

namespace App\Entity;

use App\Repository\PizzaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PizzaRepository::class)]
class Pizza
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $img;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'pizzas')]
    #[ORM\JoinColumn(nullable: false)]
    private $category;

    #[ORM\OneToMany(mappedBy: 'pizza', targetEntity: PizzaOrder::class)]
    private $pizzaorders;

    public function __construct()
    {
        $this->pizzaorders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

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
     * @return Collection<int, PizzaOrder>
     */
    public function getPizzaorders(): Collection
    {
        return $this->pizzaorders;
    }

    public function addPizzaorder(PizzaOrder $pizzaorder): self
    {
        if (!$this->pizzaorders->contains($pizzaorder)) {
            $this->pizzaorders[] = $pizzaorder;
            $pizzaorder->setPizza($this);
        }

        return $this;
    }

    public function removePizzaorder(PizzaOrder $pizzaorder): self
    {
        if ($this->pizzaorders->removeElement($pizzaorder)) {
            // set the owning side to null (unless already changed)
            if ($pizzaorder->getPizza() === $this) {
                $pizzaorder->setPizza(null);
            }
        }

        return $this;
    }
}
