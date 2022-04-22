<?php

namespace App\Entity;

use App\Repository\BreedRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BreedRepository::class)]
class Breed
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Name;

    #[ORM\Column(type: 'string', length: 255)]
    private $Description;

    #[ORM\Column(type: 'json')]
    private $modifiers = [];

    #[ORM\OneToMany(mappedBy: 'breed', targetEntity: SentenceType::class)]
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
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getModifiers(): ?array
    {
        return $this->modifiers;
    }

    public function setModifiers(array $modifiers): self
    {
        $this->modifiers = $modifiers;

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
            $sentenceType->setBreed($this);
        }

        return $this;
    }

    public function removeSentenceType(SentenceType $sentenceType): self
    {
        if ($this->sentenceTypes->removeElement($sentenceType)) {
            // set the owning side to null (unless already changed)
            if ($sentenceType->getBreed() === $this) {
                $sentenceType->setBreed(null);
            }
        }

        return $this;
    }
}
