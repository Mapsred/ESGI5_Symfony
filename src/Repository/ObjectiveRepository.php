<?php

namespace App\Repository;

use App\Entity\Objective;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;

class ObjectiveRepository
{
    private $entityManager;
    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Objective::class);
    }

    /**
     * @param Objective $objective
     * @return void
     */
    public function save(Objective $objective): void
    {
        $this->entityManager->persist($objective);
        $this->entityManager->flush();
    }

    /**
     * Creates a new QueryBuilder instance that is prepopulated for this entity name.
     *
     * @param string $alias
     * @param string $indexBy The index for the from.
     *
     * @return QueryBuilder
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        return $this->entityManager->createQueryBuilder()
            ->select($alias)
            ->from(Objective::class, $alias, $indexBy);
    }

    /**
     * @param string $bnetId
     * @return array
     */
    public function findAllByBnetId(string $bnetId): array
    {
        return $this->repository->findBy(['bnet_id' => $bnetId]);
    }

    /**
     * @param \DateTime|null $date
     * @return Objective[]
     */
    public function findByMailNotSent(\DateTime $date = null)
    {
        $qb = $this->createQueryBuilder('q')
            ->leftJoin('q.bnet_oauth_user', 'bnet_oauth_user');

        if (null !== $date) {
            $qb->where("DATE_FORMAT(q.ending_date, '%Y-%m-%d') = :date");
            $date = $date->format('Y-m-d');
        } else {
            $qb->where('q.ending_date <= :date');
            $date = new \DateTime();
        }

        return $qb->andWhere('q.mail_sent = :mail_sent')
            ->andWhere("bnet_oauth_user.email IS NOT NULL")
            ->andWhere("bnet_oauth_user.mail_enabled = :mail_enabled")
            ->setParameters([
                'date' => $date,
                'mail_sent' => false,
                'mail_enabled' => true
            ])
            ->getQuery()
            ->getResult();
    }
}
