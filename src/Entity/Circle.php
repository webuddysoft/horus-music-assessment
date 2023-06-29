<?php

namespace App\Entity;

use App\Repository\CircleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CircleRepository::class)]
class Circle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $radius = null;

    #[ORM\Column]
    private ?float $surface = null;

    #[ORM\Column]
    private ?float $circumference = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRadius(): ?float
    {
        return $this->radius;
    }

    public function setRadius(float $radius): static
    {
        $this->radius = $radius;

        return $this;
    }

    public function getSurface(): float
    {
        return $this->surface;
    }

    public function setSurface(): static
    {
        $this->surface = round(pi() * $this->radius * $this->radius, 2);

        return $this;
    }

    public function getCircumference(): float
    {
        return $this->circumference;
    }

    public function setCircumference(): static
    {
        $this->circumference = round(2 * pi() * $this->radius, 2);

        return $this;
    }
}
