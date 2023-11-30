<?php

namespace App\Entity;

use App\Repository\PointureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PointureRepository::class)]
class Pointure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $pointure = null;

    #[ORM\ManyToMany(targetEntity: Chaussure::class, mappedBy: 'pointure')]
    private Collection $chaussures;

    public function __construct()
    {

        $this->chaussures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPointure(): ?float
    {
        return $this->pointure;
    }

    public function setPointure(float $pointure): static
    {
        $this->pointure = $pointure;

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
            $chaussure->addPointure($this);
        }

        return $this;
    }

    public function removeChaussure(Chaussure $chaussure): static
    {
        if ($this->chaussures->removeElement($chaussure)) {
            $chaussure->removePointure($this);
        }

        return $this;
    }
}
