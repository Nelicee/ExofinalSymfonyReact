<?php

namespace App\Entity;


use App\Repository\UserRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;




#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['users.index'])]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    #[Groups(['users.index'])]
    private ?string $Nom = null;


    #[ORM\Column(length: 40)]
    #[Groups(['users.index'])]
    private ?string $Prenom = null;


    #[ORM\Column(length: 40)]
    #[Groups(['users.index'])]
    private ?string $Email = null;


    #[ORM\Column(length: 255)]
    #[Groups(['users.index'])]
    private ?string $Adresse = null;


    #[ORM\Column(length: 40)]
    #[Groups(['users.index'])]
    private ?string $Tel = null;


    /**
     * @var Collection<int, Possession>
     */
    #[ORM\OneToMany(targetEntity: Possession::class, mappedBy: 'user', orphanRemoval: true,)]
    private Collection $possession;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Groups(['users.index'])]
    private ?\DateTimeInterface $birthDate = null;

    public function __construct()
    {
        $this->possession = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): static
    {
        $this->Email = $Email;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): static
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->Tel;
    }

    public function setTel(string $Tel): static
    {
        $this->Tel = $Tel;

        return $this;
    }

    /**
     * @return Collection<int, Possession>
     */
    public function getPossession(): Collection
    {
        return $this->possession;
    }

    public function addPossession(Possession $possession): static
    {
        if (!$this->possession->contains($possession)) {
            $this->possession->add($possession);
            $possession->setUser($this);
        }

        return $this;
    }

    public function removePossession(Possession $possession): static
    {
        if ($this->possession->removeElement($possession)) {
            // set the owning side to null (unless already changed)
            if ($possession->getUser() === $this) {
                $possession->setUser(null);
            }
        }

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTimeInterface $birthDate): static
    {
        $this->birthDate = $birthDate;

        return $this;
    }
    // #[Groups(['users.index'])]
    // public function getAge(): ?int
    // {
    //     if (!$this->birthDate) {
    //         return null;
    //     }

    //     $now = new \Datetime();
    //     $age = $now->diff($this->birthDate)->y;

    //     return $age;
    // }
}
