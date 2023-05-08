<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'categories', targetEntity: Texte::class)]
    private Collection $Textes;

    public function __construct()
    {
        $this->Textes = new ArrayCollection();
//        $this->plats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Texte>
     */
    public function getTextes(): Collection
    {
        return $this->Textes;
    }

    public function addTexte(Texte $texte): self
    {
        if (!$this->Textes->contains($texte)) {
            $this->Textes->add($texte);
            $texte->setCategories($this);
        }

        return $this;
    }

    public function removeTexte(Texte $texte): self
    {
        if ($this->Textes->removeElement($texte)) {
            // set the owning side to null (unless already changed)
            if ($texte->getCategories() === $this) {
                $texte->setCategories(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->nom;
    }
}
