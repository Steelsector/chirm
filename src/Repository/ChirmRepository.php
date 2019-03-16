<?php

namespace App\Repository;

use App\Entity\Chirm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Chirm|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chirm|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chirm[]    findAll()
 * @method Chirm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChirmRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Chirm::class);
    }

    // /**
    //  * @return Chirm[] Returns an array of Chirm objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Chirm
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
