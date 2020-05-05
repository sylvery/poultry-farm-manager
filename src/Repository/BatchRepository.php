<?php

namespace App\Repository;

use App\Entity\Batch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Batch|null find($id, $lockMode = null, $lockVersion = null)
 * @method Batch|null findOneBy(array $criteria, array $orderBy = null)
 * @method Batch[]    findAll()
 * @method Batch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BatchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Batch::class);
    }

    /**
     * @return Batch[] Returns an array of Batch objects
     */
    public function findAllOnSale()
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.onSale = true')
            ->orderBy('b.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Batch
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
