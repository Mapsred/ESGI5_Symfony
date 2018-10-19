<?php
/**
 * Created by PhpStorm.
 * User: kuben
 * Date: 18/10/2018
 * Time: 23:43
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BnetOauthUser
 *
 * @ORM\Table(name="bnetoauthuser")
 * @ORM\Entity(repositoryClass="App\Repository\BnetOauthUserRepository")
 */
class BnetOauthUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="bnet_id", type="integer")
     */
    private $bnet_id;

    /**
     * @var string
     *
     * @ORM\Column(name="bnet_sub", type="string", length=30)
     */
    private $bnet_sub;

    /**
     * @var string
     *
     * @ORM\Column(name="bnet_battletag", type="string", length=100)
     */
    private $bnet_battletag;

    /**
     * @var string
     *
     * @ORM\Column(name="bnet_access_token", type="string")
     */
    private $bnet_access_token;

    /**
     * @var int
     *
     * @ORM\Column(name="bnet_access_created_at", type="datetime")
     */
    private $bnet_access_created_at;

    /**
     * @var int
     *
     * @ORM\Column(name="bnet_access_expires_in", type="datetime")
     */
    private $bnet_access_expires_in;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getBnetId(): int
    {
        return $this->bnet_id;
    }

    /**
     * @param int $bnet_id
     */
    public function setBnetId(int $bnet_id): void
    {
        $this->bnet_id = $bnet_id;
    }

    /**
     * @return string
     */
    public function getBnetSub(): string
    {
        return $this->bnet_sub;
    }

    /**
     * @param string $bnet_sub
     */
    public function setBnetSub(string $bnet_sub): void
    {
        $this->bnet_sub = $bnet_sub;
    }

    /**
     * @return string
     */
    public function getBnetBattletag(): string
    {
        return $this->bnet_battletag;
    }

    /**
     * @param string $bnet_battletag
     */
    public function setBnetBattletag(string $bnet_battletag): void
    {
        $this->bnet_battletag = $bnet_battletag;
    }

    /**
     * @return string
     */
    public function getBnetAccessToken(): string
    {
        return $this->bnet_access_token;
    }

    /**
     * @param string $bnet_access_token
     */
    public function setBnetAccessToken(string $bnet_access_token): void
    {
        $this->bnet_access_token = $bnet_access_token;
    }

    /**
     * @return int
     */
    public function getBnetAccessCreatedAt(): int
    {
        return $this->bnet_access_created_at;
    }

    /**
     * @param int $bnet_access_created_at
     */
    public function setBnetAccessCreatedAt(int $bnet_access_created_at): void
    {
        $this->bnet_access_created_at = $bnet_access_created_at;
    }

    /**
     * @return int
     */
    public function getBnetAccessExpiresIn(): int
    {
        return $this->bnet_access_expires_in;
    }

    /**
     * @param int $bnet_access_expires_in
     */
    public function setBnetAccessExpiresIn(int $bnet_access_expires_in): void
    {
        $this->bnet_access_expires_in = $bnet_access_expires_in;
    }





}