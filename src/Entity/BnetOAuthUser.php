<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;

/**
 * BnetOAuthUser
 *
 * @ORM\Table(name="bnet_oauth_user")
 * @ORM\Entity(repositoryClass="App\Repository\BnetOauthUserRepository")
 */
class BnetOAuthUser implements UserInterface
{
    use ORMBehaviors\Timestampable\Timestampable;

    /**
     * @var int $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int $bnet_id
     *
     * @ORM\Column(name="bnet_id", type="integer")
     */
    private $bnet_id;

    /**
     * @var string $bnet_sub
     *
     * @ORM\Column(name="bnet_sub", type="string")
     */
    private $bnet_sub;

    /**
     * @var string $bnet_battletag
     *
     * @ORM\Column(name="bnet_battletag", type="string")
     */
    private $bnet_battletag;

    /**
     * @var string $bnet_access_token
     *
     * @ORM\Column(name="bnet_access_token", type="string")
     */
    private $bnet_access_token;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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
     * @return BnetOAuthUser
     */
    public function setBnetId(int $bnet_id): self
    {
        $this->bnet_id = $bnet_id;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getBnetSub(): ?string
    {
        return $this->bnet_sub;
    }

    /**
     * @param string $bnet_sub
     * @return BnetOAuthUser
     */
    public function setBnetSub(string $bnet_sub): self
    {
        $this->bnet_sub = $bnet_sub;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getBnetBattletag(): ?string
    {
        return $this->bnet_battletag;
    }

    /**
     * @param string $bnet_battletag
     * @return BnetOAuthUser
     */
    public function setBnetBattletag(string $bnet_battletag): self
    {
        $this->bnet_battletag = $bnet_battletag;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getBnetAccessToken(): ?string
    {
        return $this->bnet_access_token;
    }

    /**
     * @param string $bnet_access_token
     * @return BnetOAuthUser
     */
    public function setBnetAccessToken(string $bnet_access_token): self
    {
        $this->bnet_access_token = $bnet_access_token;

        return $this;
    }

    /**
     * Returns the roles granted to the user.
     * @return array
     */
    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    /**
     * @return string The password
     */
    public function getPassword()
    {
        return null;
    }

    /**
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->getBnetBattletag();
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
    }
}