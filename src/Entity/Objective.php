<?php

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

    /**
     * @ORM\Column(name="deleted_at", type="datetime")
     */
    private $deleted_at;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getBnetId()
    {
        return $this->bnet_id;
    }

    public function setBnetId($bnet_id)
    {
        $this->bnet_id = $bnet_id;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getEndingDate()
    {
        return $this->ending_date;
    }

    public function setEndingDate($ending_date)
    {
        $this->ending_date = $ending_date;
        return $this;
    }

    public function getAchievementId()
    {
        return $this->achievement_id;
    }

    public function setAchievementId($achievement_id)
    {
        $this->achievement_id = $achievement_id;
        return $this;
    }

    public function getDeletedAt()
    {
        return $this->deleted_at;
    }

    public function setDeletedAt($deleted_at)
    {
        $this->deleted_at = $deleted_at;
        return $this;
    }
}