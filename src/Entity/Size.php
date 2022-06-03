<?php

namespace App\Entity;

use App\Repository\SizeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SizeRepository::class)]
class Size
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'size', targetEntity: PizzaOrder::class)]
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
            $pizzaorder->setSize($this);
        }

        return $this;
    }

    public function removePizzaorder(PizzaOrder $pizzaorder): self
    {
        if ($this->pizzaorders->removeElement($pizzaorder)) {
            // set the owning side to null (unless already changed)
            if ($pizzaorder->getSize() === $this) {
                $pizzaorder->setSize(null);
            }
        }

        return $this;
    }
}
