<?php

namespace App\Entity;

use App\Repository\FightingStyleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FightingStyleRepository::class)]
class FightingStyle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: 'json')]
    private $modifiers;

    #[ORM\Column(type: 'json')]
    private $requirements = [];

    #[ORM\OneToMany(mappedBy: 'fightingStyle', targetEntity: SentenceType::class)]
    private $sentenceTypes;

    public function __construct()
    {
        $this->sentenceTypes = new ArrayCollection();
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

    public function getModifiers(): ?string
    {
        return $this->modifiers;
    }

    public function setModifiers(string $modifiers): self
    {
        $this->modifiers = $modifiers;

        return $this;
    }

    public function getRequirements(): ?array
    {
        return $this->requirements;
    }

    public function setRequirements(array $requirements): self
    {
        $this->requirements = $requirements;

        return $this;
    }

    /**
     * @return Collection<int, SentenceType>
     */
    public function getSentenceTypes(): Collection
    {
        return $this->sentenceTypes;
    }

    public function addSentenceType(SentenceType $sentenceType): self
    {
        if (!$this->sentenceTypes->contains($sentenceType)) {
            $this->sentenceTypes[] = $sentenceType;
            $sentenceType->setFightingStyle($this);
        }

        return $this;
    }

    public function removeSentenceType(SentenceType $sentenceType): self
    {
        if ($this->sentenceTypes->removeElement($sentenceType)) {
            // set the owning side to null (unless already changed)
            if ($sentenceType->getFightingStyle() === $this) {
                $sentenceType->setFightingStyle(null);
            }
        }

        return $this;
    }
}