<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BattlePetRepository")
 */
class BattlePet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $creatureId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $spellId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $itemId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $qualityId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $icon;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $speciesId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $breedId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $petQualityId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $level;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $health;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $power;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $speed;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $battlePetGuid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $creatureName;

    /**
     * @ORM\Column(type="boolean")
     */
    private $canBattle;

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

    public function getCreatureId(): ?int
    {
        return $this->creatureId;
    }

    public function setCreatureId(int $creatureId): self
    {
        $this->creatureId = $creatureId;

        return $this;
    }

    public function getSpellId(): ?int
    {
        return $this->spellId;
    }

    public function setSpellId(?int $spellId): self
    {
        $this->spellId = $spellId;

        return $this;
    }

    public function getitemId(): ?int
    {
        return $this->itemId;
    }

    public function setItemId(?int $itemId): self
    {
        $this->itemId = $itemId;

        return $this;
    }

    public function getQualityId(): ?int
    {
        return $this->qualityId;
    }

    public function setQualityId(?int $qualityId): self
    {
        $this->qualityId = $qualityId;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function getSpeciesId(): ?int
    {
        return $this->speciesId;
    }

    public function setSpeciesId(?int $speciesId): self
    {
        $this->speciesId = $speciesId;

        return $this;
    }

    public function getBreedId(): ?int
    {
        return $this->breedId;
    }

    public function setBreedId(?int $breedId): self
    {
        $this->breedId = $breedId;

        return $this;
    }

    public function getPetQualityId(): ?int
    {
        return $this->petQualityId;
    }

    public function setPetQualityId(?int $petQualityId): self
    {
        $this->petQualityId = $petQualityId;

        return $this;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(?string $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getHealth(): ?int
    {
        return $this->health;
    }

    public function setHealth(?int $health): self
    {
        $this->health = $health;

        return $this;
    }

    public function getPower(): ?int
    {
        return $this->power;
    }

    public function setPower(?int $power): self
    {
        $this->power = $power;

        return $this;
    }

    public function getSpeed(): ?int
    {
        return $this->speed;
    }

    public function setSpeed(?int $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getBattlePetGuid(): ?string
    {
        return $this->battlePetGuid;
    }

    public function setBattlePetGuid(?string $battlePetGuid): self
    {
        $this->battlePetGuid = $battlePetGuid;

        return $this;
    }

    public function getCreatureName(): ?string
    {
        return $this->creatureName;
    }

    public function setCreatureName(string $creatureName): self
    {
        $this->creatureName = $creatureName;

        return $this;
    }

    public function getCanBattle(): ?bool
    {
        return $this->canBattle;
    }

    public function setCanBattle(bool $canBattle): self
    {
        $this->canBattle = $canBattle;

        return $this;
    }
}
