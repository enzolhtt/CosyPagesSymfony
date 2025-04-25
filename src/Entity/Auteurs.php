<?php

namespace App\Entity;

use App\Repository\AuteursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuteursRepository::class)]
class Auteurs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_naissance = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nationnalite = null;

    /**
     * @var Collection<int, Livres>
     */
    #[ORM\ManyToMany(targetEntity: Livres::class, inversedBy: 'auteurs')]
    private Collection $leslivres;

    public function __construct()
    {
        $this->leslivres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(?\DateTimeInterface $date_naissance): static
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getNationnalite(): ?string
    {
        return $this->nationnalite;
    }

    public function setNationnalite(?string $nationnalite): static
    {
        $this->nationnalite = $nationnalite;

        return $this;
    }

    /**
     * @return Collection<int, Livres>
     */
    public function getLeslivres(): Collection
    {
        return $this->leslivres;
    }

    public function addLeslivre(Livres $leslivre): static
    {
        if (!$this->leslivres->contains($leslivre)) {
            $this->leslivres->add($leslivre);
        }

        return $this;
    }

    public function removeLeslivre(Livres $leslivre): static
    {
        $this->leslivres->removeElement($leslivre);

        return $this;
    }
}
