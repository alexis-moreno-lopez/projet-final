<?php

namespace App\Entity;

use App\Repository\PaiementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaiementRepository::class)]
class Paiement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $amount = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'paiements')]
    private ?Abonner $subscribe = null;

    #[ORM\ManyToOne(inversedBy: 'paiements')]
    private ?Abonnement $subscription = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getAbonner(): ?Abonner
    {
        return $this->subscribe;
    }

    public function setAbonner(?Abonner $abonner): static
    {
        $this->subscribe = $abonner;

        return $this;
    }

    public function getSubscribe(): ?Abonnement
    {
        return $this->subscription;
    }

    public function setSubscription(?Abonnement $subscription): static
    {
        $this->subscription = $subscription;

        return $this;
    }
}
