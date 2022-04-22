<?php

namespace App\Entity;

use App\Repository\CombatLineRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CombatLineRepository::class)]
class CombatLine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Combat::class, inversedBy: 'Lines')]
    #[ORM\JoinColumn(nullable: false)]
    private $Combat;

    #[ORM\ManyToOne(targetEntity: Warrior::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $attacker;

    #[ORM\ManyToOne(targetEntity: warrior::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $defender;

    #[ORM\Column(type: 'string', length: 255)]
    private $text;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCombat(): ?Combat
    {
        return $this->Combat;
    }

    public function setCombat(?Combat $Combat): self
    {
        $this->Combat = $Combat;

        return $this;
    }

    public function getAttacker(): ?Warrior
    {
        return $this->attacker;
    }

    public function setAttacker(?Warrior $attacker): self
    {
        $this->attacker = $attacker;

        return $this;
    }

    public function getDefender(): ?warrior
    {
        return $this->defender;
    }

    public function setDefender(?warrior $defender): self
    {
        $this->defender = $defender;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }
}
