<?php

namespace App\Entity;

use App\Repository\CombatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CombatRepository::class)]
class Combat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToMany(targetEntity: Warrior::class, inversedBy: 'combats')]
    private $warriors;

    #[ORM\Column(type: 'datetime')]
    private $date;

    #[ORM\OneToMany(mappedBy: 'Combat', targetEntity: CombatLine::class)]
    private $Lines;

    public function __construct()
    {
        $this->warriors = new ArrayCollection();
        $this->Lines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Warrior>
     */
    public function getWarriors(): Collection
    {
        return $this->warriors;
    }

    public function addWarrior(Warrior $warrior): self
    {
        if (!$this->warriors->contains($warrior)) {
            $this->warriors[] = $warrior;
        }

        return $this;
    }

    public function removeWarrior(Warrior $warrior): self
    {
        $this->warriors->removeElement($warrior);

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, CombatLine>
     */
    public function getLines(): Collection
    {
        return $this->Lines;
    }

    public function addLine(CombatLine $line): self
    {
        if (!$this->Lines->contains($line)) {
            $this->Lines[] = $line;
            $line->setCombat($this);
        }

        return $this;
    }

    public function removeLine(CombatLine $line): self
    {
        if ($this->Lines->removeElement($line)) {
            // set the owning side to null (unless already changed)
            if ($line->getCombat() === $this) {
                $line->setCombat(null);
            }
        }

        return $this;
    }
}
