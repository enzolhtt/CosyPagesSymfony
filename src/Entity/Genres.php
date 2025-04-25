<?php

namespace App\Entity;

use App\Repository\GenresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenresRepository::class)]
class Genres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Livres>
     */
    #[ORM\OneToMany(targetEntity: Livres::class, mappedBy: 'genres')]
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
            $leslivre->setGenres($this);
        }

        return $this;
    }

    public function removeLeslivre(Livres $leslivre): static
    {
        if ($this->leslivres->removeElement($leslivre)) {
            // set the owning side to null (unless already changed)
            if ($leslivre->getGenres() === $this) {
                $leslivre->setGenres(null);
            }
        }

        return $this;
    }

}
