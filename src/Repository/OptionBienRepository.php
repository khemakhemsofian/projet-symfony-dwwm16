<?php

namespace App\Repository;

use App\Entity\OptionBien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OptionBien|null find($id, $lockMode = null, $lockVersion = null)
 * @method OptionBien|null findOneBy(array $criteria, array $orderBy = null)
 * @method OptionBien[]    findAll()
 * @method OptionBien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OptionBienRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OptionBien::class);
    }

    // /**
    //  * @return OptionBien[] Returns an array of OptionBien objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OptionBien
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
