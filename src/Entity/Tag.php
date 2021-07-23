<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Voyage::class, mappedBy="tag")
     */
    private $voyages;

    public function __construct()
    {
        $this->voyages = new ArrayCollection();
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
            $voyage->addTag($this);
        }

        return $this;
    }

    public function removeVoyage(Voyage $voyage): self
    {
        if ($this->voyages->removeElement($voyage)) {
            $voyage->removeTag($this);
        }

        return $this;
    }
}
