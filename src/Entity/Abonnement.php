<?php

namespace App\Entity;

use App\Repository\AbonnementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AbonnementRepository::class)]
class Abonnement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?string $tarif = null;



    #[ORM\OneToMany(targetEntity: Abonner::class, mappedBy: 'subscription', orphanRemoval: true)]
    private Collection $abonners;

    #[ORM\Column(length: 255)]
    private ?string $textSchedule = null;

    #[ORM\Column(length: 255)]
    private ?string $textActivity = null;

    #[ORM\Column(length: 255)]
    private ?string $textRecipe = null;

    #[ORM\Column(length: 255)]
    private ?string $textSpa = null;

    #[ORM\Column(length: 255)]
    private ?string $textCoach = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 500)]
    private ?string $textDescription = null;

    public function __construct()
    {
        $this->abonners = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
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

    public function getTarif(): ?string
    {
        return $this->tarif;
    }

    public function setTarif(string $tarif): static
    {
        $this->tarif = $tarif;

        return $this;
    }



    /**
     * @return Collection<int, Abonner>
     */
    public function getAbonners(): Collection
    {
        return $this->abonners;
    }

    public function addAbonner(Abonner $abonner): static
    {
        if (!$this->abonners->contains($abonner)) {
            $this->abonners->add($abonner);
            $abonner->setSubscription($this);
        }

        return $this;
    }

    public function removeAbonner(Abonner $abonner): static
    {
        if ($this->abonners->removeElement($abonner)) {
            // set the owning side to null (unless already changed)
            if ($abonner->getSubscription() === $this) {
                $abonner->setSubscription(null);
            }
        }

        return $this;
    }

    public function getTextSchedule(): ?string
    {
        return $this->textSchedule;
    }

    public function setTextSchedule(string $textSchedule): static
    {
        $this->textSchedule = $textSchedule;

        return $this;
    }

    public function getTextActivity(): ?string
    {
        return $this->textActivity;
    }

    public function setTextActivity(string $textActivity): static
    {
        $this->textActivity = $textActivity;

        return $this;
    }

    public function getTextRecipe(): ?string
    {
        return $this->textRecipe;
    }

    public function setTextRecipe(string $textRecipe): static
    {
        $this->textRecipe = $textRecipe;

        return $this;
    }

    public function getTextSpa(): ?string
    {
        return $this->textSpa;
    }

    public function setTextSpa(string $textSpa): static
    {
        $this->textSpa = $textSpa;

        return $this;
    }

    public function getTextCoach(): ?string
    {
        return $this->textCoach;
    }

    public function setTextCoach(string $textCoach): static
    {
        $this->textCoach = $textCoach;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getTextDescription(): ?string
    {
        return $this->textDescription;
    }

    public function setTextDescription(string $textDescription): static
    {
        $this->textDescription = $textDescription;

        return $this;
    }

}
