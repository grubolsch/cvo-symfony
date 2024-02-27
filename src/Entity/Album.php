<?php

namespace App\Entity;

use App\Repository\AlbumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlbumRepository::class)]
class Album
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Smurf::class, inversedBy: 'albums')]
    private Collection $smurfen;

    public function __construct()
    {
        $this->smurfen = new ArrayCollection();
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
     * @return Collection<int, Smurf>
     */
    public function getSmurfen(): Collection
    {
        return $this->smurfen;
    }

    public function addSmurfen(Smurf $smurfen): static
    {
        if (!$this->smurfen->contains($smurfen)) {
            $this->smurfen->add($smurfen);
        }

        return $this;
    }

    public function removeSmurfen(Smurf $smurfen): static
    {
        $this->smurfen->removeElement($smurfen);

        return $this;
    }

    public function __toString() : string
    {
        return $this->name;
    }
}
