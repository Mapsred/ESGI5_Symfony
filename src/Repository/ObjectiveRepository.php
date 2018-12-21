<?php

namespace App\Repository;

use App\Entity\Objective;
use Doctrine\ORM\EntityManagerInterface;

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
     * @param string $bnetId
     * @return array
     */
    public function findAllByBnetId(string $bnetId): array
    {
        return $this->repository->findBy(['bnet_id' => $bnetId]);
    }
}
