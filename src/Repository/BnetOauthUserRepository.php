<?php

namespace App\Repository;

use App\Entity\BnetOAuthUser;
use Doctrine\ORM\EntityRepository;

/**
 * BnetOAuthUserRepository
 *
 * @method BnetOAuthUser|object|null findOneBy(array $criteria, array $orderBy = null)
 * @method BnetOAuthUser[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method BnetOAuthUser find($id, $lockMode = null, $lockVersion = null)
 */
class BnetOauthUserRepository extends EntityRepository
{
    /**
     * @param $bnetId
     * @return BnetOAuthUser|null|object
     */
    public function findOneByBnetId($bnetId): BnetOAuthUser
    {
        return $this->findOneBy(['bnet_id' => $bnetId]);
    }
}