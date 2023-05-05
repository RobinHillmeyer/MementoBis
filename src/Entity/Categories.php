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

//    #[ORM\OneToMany(mappedBy: 'categories', targetEntity: Plat::class)]
//    private Collection $plats;

//    #[ORM\OneToMany(mappedBy: 'CategoriesId', targetEntity: PlatsSale::class)]
//    private Collection $platsSales;
//
//    #[ORM\OneToMany(mappedBy: 'CategoriesId', targetEntity: PlatsSucre::class)]
//    private Collection $platsSucres;

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

//    /**
//     * @return Collection<int, PlatsSale>
//     */
//    public function getPlatsSales(): Collection
//    {
//        return $this->platsSales;
//    }
//
//    public function addPlatsSale(PlatsSale $platsSale): self
//    {
//        if (!$this->platsSales->contains($platsSale)) {
//            $this->platsSales->add($platsSale);
//            $platsSale->setCategoriesId($this);
//        }
//
//        return $this;
//    }
//
//    public function removePlatsSale(PlatsSale $platsSale): self
//    {
//        if ($this->platsSales->removeElement($platsSale)) {
//            // set the owning side to null (unless already changed)
//            if ($platsSale->getCategoriesId() === $this) {
//                $platsSale->setCategoriesId(null);
//            }
//        }
//
//        return $this;
//    }
//
//    /**
//     * @return Collection<int, PlatsSucre>
//     */
//    public function getPlatsSucres(): Collection
//    {
//        return $this->platsSucres;
//    }
//
//    public function addPlatsSucre(PlatsSucre $platsSucre): self
//    {
//        if (!$this->platsSucres->contains($platsSucre)) {
//            $this->platsSucres->add($platsSucre);
//            $platsSucre->setCategoriesId($this);
//        }
//
//        return $this;
//    }
//
//    public function removePlatsSucre(PlatsSucre $platsSucre): self
//    {
//        if ($this->platsSucres->removeElement($platsSucre)) {
//            // set the owning side to null (unless already changed)
//            if ($platsSucre->getCategoriesId() === $this) {
//                $platsSucre->setCategoriesId(null);
//            }
//        }
//
//        return $this;
//    }

///**
// * @return Collection<int, Plat>
// */
//public function getPlats(): Collection
//{
//    return $this->plats;
//}
//
//public function addPlat(Plat $plat): self
//{
//    if (!$this->plats->contains($plat)) {
//        $this->plats->add($plat);
//        $plat->setCategories($this);
//    }
//
//    return $this;
//}
//
//public function removePlat(Plat $plat): self
//{
//    if ($this->plats->removeElement($plat)) {
//        // set the owning side to null (unless already changed)
//        if ($plat->getCategories() === $this) {
//            $plat->setCategories(null);
//        }
//    }
//
//    return $this;
//}
}
