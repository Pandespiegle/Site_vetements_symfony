<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: Vetement::class, mappedBy: 'categorie')]
    private $vetements;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Chaussure::class)]
    private Collection $chaussures;

    public function __construct()
    {
        $this->chaussures = new ArrayCollection();
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

    /**
     * @return Collection<int, Chaussure>
     */
    public function getChaussures(): Collection
    {
        return $this->chaussures;
    }

    public function addChaussure(Chaussure $chaussure): static
    {
        if (!$this->chaussures->contains($chaussure)) {
            $this->chaussures->add($chaussure);
            $chaussure->setCategorie($this);
        }

        return $this;
    }

    public function removeChaussure(Chaussure $chaussure): static
    {
        if ($this->chaussures->removeElement($chaussure)) {
            // set the owning side to null (unless already changed)
            if ($chaussure->getCategorie() === $this) {
                $chaussure->setCategorie(null);
            }
        }

        return $this;
    }
}
