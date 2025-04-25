<?php

namespace App\Entity;

use App\Repository\EditeursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EditeursRepository::class)]
class Editeurs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $site_web = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    /**
     * @var Collection<int, Livres>
     */
    #[ORM\OneToMany(targetEntity: Livres::class, mappedBy: 'editeurs')]
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getSiteWeb(): ?string
    {
        return $this->site_web;
    }

    public function setSiteWeb(?string $site_web): static
    {
        $this->site_web = $site_web;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

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
            $leslivre->setEditeurs($this);
        }

        return $this;
    }

    public function removeLeslivre(Livres $leslivre): static
    {
        if ($this->leslivres->removeElement($leslivre)) {
            // set the owning side to null (unless already changed)
            if ($leslivre->getEditeurs() === $this) {
                $leslivre->setEditeurs(null);
            }
        }

        return $this;
    }
}
