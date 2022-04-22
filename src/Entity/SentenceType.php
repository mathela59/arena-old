<?php

namespace App\Entity;

use App\Repository\SentenceTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SentenceTypeRepository::class)]
class SentenceType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: 'string', length: 255)]
    private $shortcode;

    #[ORM\OneToMany(mappedBy: 'type', targetEntity: Sentence::class)]
    private $sentences;

    #[ORM\ManyToOne(targetEntity: FightingStyle::class, inversedBy: 'sentenceTypes')]
    private $fightingStyle;

    #[ORM\ManyToOne(targetEntity: Breed::class, inversedBy: 'sentenceTypes')]
    private $breed;

    public function __construct()
    {
        $this->sentences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getShortcode(): ?string
    {
        return $this->shortcode;
    }

    public function setShortcode(string $shortcode): self
    {
        $this->shortcode = $shortcode;

        return $this;
    }

    /**
     * @return Collection<int, Sentence>
     */
    public function getSentences(): Collection
    {
        return $this->sentences;
    }

    public function addSentence(Sentence $sentence): self
    {
        if (!$this->sentences->contains($sentence)) {
            $this->sentences[] = $sentence;
            $sentence->setType($this);
        }

        return $this;
    }

    public function removeSentence(Sentence $sentence): self
    {
        if ($this->sentences->removeElement($sentence)) {
            // set the owning side to null (unless already changed)
            if ($sentence->getType() === $this) {
                $sentence->setType(null);
            }
        }

        return $this;
    }

    public function getFightingStyle(): ?FightingStyle
    {
        return $this->fightingStyle;
    }

    public function setFightingStyle(?FightingStyle $fightingStyle): self
    {
        $this->fightingStyle = $fightingStyle;

        return $this;
    }

    public function getBreed(): ?Breed
    {
        return $this->breed;
    }

    public function setBreed(?Breed $breed): self
    {
        $this->breed = $breed;

        return $this;
    }
}
