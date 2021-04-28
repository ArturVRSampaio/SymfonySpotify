<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
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
     * @ORM\Column(type="date")
     */
    private $birthDate;

    /**
     * @ORM\ManyToOne(targetEntity=Plan::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $plan;

    /**
     * @ORM\OneToOne(targetEntity=CreditCard::class, mappedBy="user", cascade={"ALL"})
     */
    private $creditCard;

    /**
     * @ORM\OneToOne(targetEntity=Address::class, mappedBy="user", cascade={"ALL"})
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity=Avaliation::class, mappedBy="user")
     */
    private $avaliations;

    public function __construct()
    {
        $this->avaliations = new ArrayCollection();
    }
    
    public function __toString() {
        return $this->name;
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

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getPlan(): ?Plan
    {
        return $this->plan;
    }

    public function setPlan(?Plan $plan): self
    {
        $this->plan = $plan;

        return $this;
    }

    public function getCreditCard(): ?CreditCard
    {
        return $this->creditCard;
    }

    public function setCreditCard(?CreditCard $creditCard): self
    {
        // unset the owning side of the relation if necessary
        if ($creditCard === null && $this->creditCard !== null) {
            $this->creditCard->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($creditCard !== null && $creditCard->getUser() !== $this) {
            $creditCard->setUser($this);
        }

        $this->creditCard = $creditCard;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        // unset the owning side of the relation if necessary
        if ($address === null && $this->address !== null) {
            $this->address->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($address !== null && $address->getUser() !== $this) {
            $address->setUser($this);
        }

        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection|Avaliation[]
     */
    public function getAvailable(): Collection
    {
        return $this->available;
    }

    public function addAvailable(Avaliation $available): self
    {
        if (!$this->available->contains($available)) {
            $this->available[] = $available;
            $available->setUser($this);
        }

        return $this;
    }

    public function removeAvailable(Avaliation $available): self
    {
        if ($this->available->removeElement($available)) {
            // set the owning side to null (unless already changed)
            if ($available->getUser() === $this) {
                $available->setUser(null);
            }
        }

        return $this;
    }

}
