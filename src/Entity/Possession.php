<?php

namespace App\Entity;

use App\Repository\PossessionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;



#[ORM\Entity(repositoryClass: PossessionRepository::class)]
class Possession
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user.details'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user.details'])]
    private ?string $nom = null;

    #[ORM\Column]
    #[Groups(['user.details'])]
    private ?float $valeur = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user.details'])]
    private ?string $type = null;

    #[ORM\ManyToOne(inversedBy: 'possession')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getValeur(): ?float
    {
        return $this->valeur;
    }

    public function setValeur(float $valeur): static
    {
        $this->valeur = $valeur;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
