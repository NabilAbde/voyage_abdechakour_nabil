<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Voyage::class, mappedBy="Category", orphanRemoval=true)
     */
    private $voyages;

    /**
     * @ORM\OneToMany(targetEntity=Voyage::class, mappedBy="Categorie", orphanRemoval=true)
     */
    private $voyage;

    public function __construct()
    {
        $this->voyages = new ArrayCollection();
        $this->voyage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    /**
     * @return Collection|Voyage[]
     */
    public function getVoyages(): Collection
    {
        return $this->voyages;
    }

    public function addVoyage(Voyage $voyage): self
    {
        if (!$this->voyages->contains($voyage)) {
            $this->voyages[] = $voyage;
            $voyage->setCategory($this);
        }

        return $this;
    }

    public function removeVoyage(Voyage $voyage): self
    {
        if ($this->voyages->removeElement($voyage)) {
            // set the owning side to null (unless already changed)
            if ($voyage->getCategory() === $this) {
                $voyage->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Voyage[]
     */
    public function getVoyage(): Collection
    {
        return $this->voyage;
    }
}
