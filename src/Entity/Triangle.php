<?php

namespace App\Entity;

use App\Repository\TriangleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TriangleRepository::class)]
class Triangle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $a = null;

    #[ORM\Column]
    private ?float $b = null;

    #[ORM\Column]
    private ?float $c = null;

    #[ORM\Column]
    private ?float $surface = null;

    #[ORM\Column]
    private ?float $circumference = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getA(): ?float
    {
        return $this->a;
    }

    public function setA(float $a): static
    {
        $this->a = $a;

        return $this;
    }

    public function getB(): ?float
    {
        return $this->b;
    }

    public function setB(float $b): static
    {
        $this->b = $b;

        return $this;
    }

    public function getC(): ?float
    {
        return $this->c;
    }

    public function setC(float $c): static
    {
        $this->c = $c;

        return $this;
    }
    
    public function getSurface(): float
    {
        return $this->surface;
    }

    public function setSurface(): static
    {
        $s = ($this->a + $this->b + $this->c) / 2;
        $this->surface = round(sqrt($s * ($s - $this->a) * ($s - $this->b) * ($s - $this->c)), 2);

        return $this;
    }

    public function getCircumference(): float
    {
        return $this->circumference;
    }

    public function setCircumference(): static
    {
        $this->circumference = round($this->a + $this->b + $this->c, 2);

        return $this;
    }
}
