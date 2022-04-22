<?php

namespace App\Entity;

use App\Repository\WarriorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WarriorRepository::class)]
class Warrior
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToOne(targetEntity: Breed::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $race;

    #[ORM\ManyToOne(targetEntity: FightingStyle::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $Style;

    #[ORM\OneToMany(mappedBy: 'Warrior', targetEntity: Equipment::class, orphanRemoval: true)]
    private $equipment;

    #[ORM\OneToOne(mappedBy: 'warrior', targetEntity: Characteristics::class, cascade: ['persist', 'remove'])]
    private $characteristics;

    #[ORM\ManyToMany(targetEntity: Combat::class, mappedBy: 'warriors')]
    private $combats;

    #[ORM\Column(type: 'integer')]
    private $experience;

    #[ORM\Column(type: 'integer')]
    private $rank;

    public function __construct()
    {
        $this->equipment = new ArrayCollection();
        $this->combats = new ArrayCollection();
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

    public function getRace(): ?Breed
    {
        return $this->race;
    }

    public function setRace(?Breed $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getStyle(): ?FightingStyle
    {
        return $this->Style;
    }

    public function setStyle(?FightingStyle $Style): self
    {
        $this->Style = $Style;

        return $this;
    }

    /**
     * @return Collection<int, Equipment>
     */
    public function getEquipment(): Collection
    {
        return $this->equipment;
    }

    public function addEquipment(Equipment $equipment): self
    {
        if (!$this->equipment->contains($equipment)) {
            $this->equipment[] = $equipment;
            $equipment->setWarrior($this);
        }

        return $this;
    }

    public function removeEquipment(Equipment $equipment): self
    {
        if ($this->equipment->removeElement($equipment)) {
            // set the owning side to null (unless already changed)
            if ($equipment->getWarrior() === $this) {
                $equipment->setWarrior(null);
            }
        }

        return $this;
    }

    public function getCharacteristics(): ?Characteristics
    {
        return $this->characteristics;
    }

    public function setCharacteristics(Characteristics $characteristics): self
    {
        // set the owning side of the relation if necessary
        if ($characteristics->getWarrior() !== $this) {
            $characteristics->setWarrior($this);
        }

        $this->characteristics = $characteristics;

        return $this;
    }

    /**
     * @return Collection<int, Combat>
     */
    public function getCombats(): Collection
    {
        return $this->combats;
    }

    public function addCombat(Combat $combat): self
    {
        if (!$this->combats->contains($combat)) {
            $this->combats[] = $combat;
            $combat->addWarrior($this);
        }

        return $this;
    }

    public function removeCombat(Combat $combat): self
    {
        if ($this->combats->removeElement($combat)) {
            $combat->removeWarrior($this);
        }

        return $this;
    }

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(int $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getRank(): ?int
    {
        return $this->rank;
    }

    public function setRank(int $rank): self
    {
        $this->rank = $rank;

        return $this;
    }
}
