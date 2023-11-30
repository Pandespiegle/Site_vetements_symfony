<?php

namespace App\Entity;

use App\Repository\VetementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VetementRepository::class)]
class Vetement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageUrl = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: 'vetements')]
    private ?Categorie $categorie = null;

    #[ORM\ManyToOne(targetEntity: Marque::class, inversedBy: 'vetements')]  
    private ?Marque $marque = null;

    #[ORM\ManyToMany(targetEntity: Taille::class, inversedBy: 'Vetements')]
    private Collection $tailles;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $commentaire = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $deletedAt = null;

    
    public function __construct()
    {
        $this->tailles = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();

    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): static
    {
        $this->imageUrl = $imageUrl;
        $this->updatedAt = new \DateTimeImmutable();

        return $this;
    }
    

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): static
    {
        $this->marque = $marque;
        $this->updatedAt = new \DateTimeImmutable();

        return $this;
    }
    

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;
        $this->updatedAt = new \DateTimeImmutable();

        return $this;
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
        $this->updatedAt = new \DateTimeImmutable();

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;
        $this->updatedAt = new \DateTimeImmutable();

        return $this;
    }

    public function getTailles(): Collection
    {
        return $this->tailles;
    }

    public function addTaille(Taille $taille): static
    {
        if (!$this->tailles->contains($taille)) {
            $this->tailles->add($taille);
            $this->updatedAt = new \DateTimeImmutable();

        }

        return $this;
    }

    public function removeTaille(Taille $taille): static
    {
        $this->tailles->removeElement($taille);

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

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): static
    {
        $this->commentaire = $commentaire;
        $this->updatedAt = new \DateTimeImmutable();

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDeletedAt(): ?\DateTimeImmutable
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTimeImmutable $deletedAt): static
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }
}
