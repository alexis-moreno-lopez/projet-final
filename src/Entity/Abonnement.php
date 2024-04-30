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
    private ?int $tarif = null;

    #[ORM\Column(length: 255)]
    private ?string $text = null;

    #[ORM\OneToMany(targetEntity: Abonner::class, mappedBy: 'subscription', orphanRemoval: true)]
    private Collection $abonners;

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

    public function getTarif(): ?int
    {
        return $this->tarif;
    }

    public function setTarif(int $tarif): static
    {
        $this->tarif = $tarif;

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

}
