<?php

namespace App\Entity;

use App\Repository\CharacteristicsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CharacteristicsRepository::class)]
class Characteristics
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(inversedBy: 'characteristics', targetEntity: Warrior::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $warrior;

    #[ORM\Column(type: 'integer')]
    private $Strength;

    #[ORM\Column(type: 'integer')]
    private $dexterity;

    #[ORM\Column(type: 'integer')]
    private $speed;

    #[ORM\Column(type: 'integer')]
    private $intelligence;

    #[ORM\Column(type: 'integer')]
    private $willPower;

    #[ORM\Column(type: 'integer')]
    private $luck;

    #[ORM\Column(type: 'integer')]
    private $charism;

    #[ORM\Column(type: 'integer')]
    private $stamina;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWarrior(): ?Warrior
    {
        return $this->warrior;
    }

    public function setWarrior(Warrior $warrior): self
    {
        $this->warrior = $warrior;

        return $this;
    }

    public function getStrength(): ?int
    {
        return $this->Strength;
    }

    public function setStrength(int $Strength): self
    {
        $this->Strength = $Strength;

        return $this;
    }

    public function getDexterity(): ?int
    {
        return $this->dexterity;
    }

    public function setDexterity(int $dexterity): self
    {
        $this->dexterity = $dexterity;

        return $this;
    }

    public function getSpeed(): ?int
    {
        return $this->speed;
    }

    public function setSpeed(int $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getIntelligence(): ?int
    {
        return $this->intelligence;
    }

    public function setIntelligence(int $intelligence): self
    {
        $this->intelligence = $intelligence;

        return $this;
    }

    public function getWillPower(): ?int
    {
        return $this->willPower;
    }

    public function setWillPower(int $willPower): self
    {
        $this->willPower = $willPower;

        return $this;
    }

    public function getLuck(): ?int
    {
        return $this->luck;
    }

    public function setLuck(int $luck): self
    {
        $this->luck = $luck;

        return $this;
    }

    public function getCharism(): ?int
    {
        return $this->charism;
    }

    public function setCharism(int $charism): self
    {
        $this->charism = $charism;

        return $this;
    }

    public function getStamina(): ?int
    {
        return $this->stamina;
    }

    public function setStamina(int $stamina): self
    {
        $this->stamina = $stamina;

        return $this;
    }
}
