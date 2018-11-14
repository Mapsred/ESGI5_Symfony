<?php declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * @ORM\Table(name="objectives")
 * @ORM\Entity(repositoryClass="App\Repository\ObjectiveRepository")
 */
class Objective
{
    use ORMBehaviors\Timestampable\Timestampable;
    use ORMBehaviors\SoftDeletable\SoftDeletable;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="bnet_id", type="integer")
     */
    private $bnet_id;

    /**
     * @ORM\Column(name="title", type="string")
     */
    private $title;

    /**
     * @ORM\Column(name="ending_date", type="datetime")
     */
    private $ending_date;

    /**
     * @ORM\Column(name="achievement_id", type="integer")
     */
    private $achievement_id;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getBnetId(): ?int
    {
        return $this->bnet_id;
    }

    public function setBnetId(int $bnet_id): self
    {
        $this->bnet_id = $bnet_id;
        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getEndingDate(): ?\DateTime
    {
        return $this->ending_date;
    }

    public function setEndingDate(\DateTime $ending_date): self
    {
        $this->ending_date = $ending_date;
        return $this;
    }

    public function getAchievementId(): ?int
    {
        return $this->achievement_id;
    }

    public function setAchievementId(int $achievement_id): self
    {
        $this->achievement_id = $achievement_id;
        return $this;
    }
}