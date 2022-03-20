<?php

namespace App\Repository;

use App\Entity\ImageBien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ImageBien|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageBien|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageBien[]    findAll()
 * @method ImageBien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageBienRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageBien::class);
    }

    // /**
    //  * @return ImageBien[] Returns an array of ImageBien objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ImageBien
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
