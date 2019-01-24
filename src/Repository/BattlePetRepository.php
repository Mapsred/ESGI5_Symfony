<?php

namespace App\Repository;

use App\Entity\BattlePet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BattlePet|null find($id, $lockMode = null, $lockVersion = null)
 * @method BattlePet|null findOneBy(array $criteria, array $orderBy = null)
 * @method BattlePet[]    findAll()
 * @method BattlePet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BattlePetRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BattlePet::class);
    }

    // /**
    //  * @return BattlePet[] Returns an array of BattlePet objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BattlePet
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
