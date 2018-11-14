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
     * @var int $id
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var int $bnet_id
     * @ORM\Column(name="bnet_id", type="integer")
     */
    private $bnet_id;

    /**
     * @var string $title
     * @ORM\Column(name="title", type="string")
     */
    private $title;

    /**
     * @var \DateTime $ending_date
     * @ORM\Column(name="ending_date", type="datetime")
     */
    private $ending_date;

    /**
     * @var int $achievement_id
     * @ORM\Column(name="achievement_id", type="integer")
     */
    private $achievement_id;


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Objective
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getBnetId(): ?int
    {
        return $this->bnet_id;
    }

    /**
     * @param int $bnet_id
     * @return Objective
     */
    public function setBnetId(int $bnet_id): self
    {
        $this->bnet_id = $bnet_id;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Objective
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getEndingDate(): ?\DateTime
    {
        return $this->ending_date;
    }

    /**
     * @param \DateTime $ending_date
     * @return Objective
     */
    public function setEndingDate(\DateTime $ending_date): self
    {
        $this->ending_date = $ending_date;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getAchievementId(): ?int
    {
        return $this->achievement_id;
    }

    /**
     * @param int $achievement_id
     * @return Objective
     */
    public function setAchievementId(int $achievement_id): self
    {
        $this->achievement_id = $achievement_id;

        return $this;
    }
}