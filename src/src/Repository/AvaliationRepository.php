<?php

namespace App\Repository;

use App\Entity\Avaliation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Avaliation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Avaliation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Avaliation[]    findAll()
 * @method Avaliation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvaliationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Avaliation::class);
    }

    // /**
    //  * @return Avaliation[] Returns an array of Avaliation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Avaliation
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
