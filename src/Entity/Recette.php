<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecetteRepository::class)]
class Recette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[ORM\Column(length: 255)]
    private ?string $text = null;

    #[ORM\ManyToMany(targetEntity: Coach::class, inversedBy: 'recettes')]
    private Collection $coach;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\Column(length: 255)]
    private ?string $summarize = null;

    #[ORM\Column]
    private ?int $time = null;

    #[ORM\Column(length: 255)]
    private ?string $ingredient = null;

    public function __construct()
    {
        $this->coach = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): static
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return Collection<int, Coach>
     */
    public function getCoach(): Collection
    {
        return $this->coach;
    }

    public function addCoach(Coach $coach): static
    {
        if (!$this->coach->contains($coach)) {
            $this->coach->add($coach);
        }

        return $this;
    }

    public function removeCoach(Coach $coach): static
    {
        $this->coach->removeElement($coach);

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getSummarize(): ?string
    {
        return $this->summarize;
    }

    public function setSummarize(string $summarize): static
    {
        $this->summarize = $summarize;

        return $this;
    }

    public function getTime(): ?int
    {
        return $this->time;
    }

    public function setTime(int $time): static
    {
        $this->time = $time;

        return $this;
    }

    public function getIngredient(): ?string
    {
        return $this->ingredient;
    }

    public function setIngredient(string $ingredient): static
    {
        $this->ingredient = $ingredient;

        return $this;
    }
}
