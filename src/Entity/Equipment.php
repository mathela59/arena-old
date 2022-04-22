<?php

namespace App\Entity;

use App\Repository\EquipmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipmentRepository::class)]
class Equipment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Warrior::class, inversedBy: 'equipment')]
    #[ORM\JoinColumn(nullable: false)]
    private $Warrior;

    #[ORM\ManyToOne(targetEntity: Slot::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $slot;

    #[ORM\ManyToOne(targetEntity: Item::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $Item;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWarrior(): ?Warrior
    {
        return $this->Warrior;
    }

    public function setWarrior(?Warrior $Warrior): self
    {
        $this->Warrior = $Warrior;

        return $this;
    }

    public function getSlot(): ?Slot
    {
        return $this->slot;
    }

    public function setSlot(?Slot $slot): self
    {
        $this->slot = $slot;

        return $this;
    }

    public function getItem(): ?Item
    {
        return $this->Item;
    }

    public function setItem(?Item $Item): self
    {
        $this->Item = $Item;

        return $this;
    }
}
