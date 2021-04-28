<?php

namespace App\Entity;

use App\Repository\MusicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MusicRepository::class)
 */
class Music
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Album::class, inversedBy="musics")
     * @ORM\JoinColumn(nullable=false)
     */
    private $album;

    /**
     * @ORM\OneToMany(targetEntity=Avaliation::class, mappedBy="music")
     */
    private $avaliations;

    public function __construct()
    {
        $this->avaliations = new ArrayCollection();
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

    public function getAlbum(): ?Album
    {
        return $this->album;
    }

    public function setAlbum(?Album $album): self
    {
        $this->album = $album;

        return $this;
    }

    /**
     * @return Collection|Avaliation[]
     */
    public function getAvaliations(): Collection
    {
        return $this->avaliations;
    }

    public function addAvaliation(Avaliation $avaliation): self
    {
        if (!$this->avaliations->contains($avaliation)) {
            $this->avaliations[] = $avaliation;
            $avaliation->setMusic($this);
        }

        return $this;
    }

    public function removeAvaliation(Avaliation $avaliation): self
    {
        if ($this->avaliations->removeElement($avaliation)) {
            // set the owning side to null (unless already changed)
            if ($avaliation->getMusic() === $this) {
                $avaliation->setMusic(null);
            }
        }

        return $this;
    }
}
