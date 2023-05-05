<?php

namespace App\Entity;

use App\Repository\TexteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TexteRepository::class)]
class Texte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'Textes')]
    private ?Categories $categories = null;

    #[ORM\Column]
    private ?bool $etat = null;

    #[ORM\OneToMany(mappedBy: 'texte', targetEntity: Image::class, cascade: ['persist'])]
    private Collection $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

//    /**
//     * @return Collection<int, ImagesTexte>
//     */
//    public function getImagesTexte(): Collection
//    {
//        return $this->imagesTexte;
//    }
//
//    public function addImagesTexte(ImagesTexte $imagesTexte): self
//    {
//        if (!$this->imagesTexte->contains($imagesTexte)) {
//            $this->imagesTexte->add($imagesTexte);
//            $imagesTexte->setTexte($this);
//        }
//
//        return $this;
//    }
//
//    public function removeImagesTexte(ImagesTexte $imagesTexte): self
//    {
//        if ($this->imagesTexte->removeElement($imagesTexte)) {
//            // set the owning side to null (unless already changed)
//            if ($imagesTexte->getTexte() === $this) {
//                $imagesTexte->setTexte(null);
//            }
//        }
//
//        return $this;
//    }

    public function isEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setTexte($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getTexte() === $this) {
                $image->setTexte(null);
            }
        }

        return $this;
    }
}
