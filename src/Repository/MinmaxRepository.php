<?php

namespace App\Repository;

use App\Entity\Minmax;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Minmax>
 *
 * @method Minmax|null find($id, $lockMode = null, $lockVersion = null)
 * @method Minmax|null findOneBy(array $criteria, array $orderBy = null)
 * @method Minmax[]    findAll()
 * @method Minmax[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MinmaxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Minmax::class);
    }

//    /**
//     * @return Minmax[] Returns an array of Minmax objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Minmax
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
