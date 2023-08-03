<?php

namespace App\Repository;

use App\Entity\RecieptStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RecieptStatus>
 *
 * @method RecieptStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecieptStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecieptStatus[]    findAll()
 * @method RecieptStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecieptStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecieptStatus::class);
    }

//    /**
//     * @return RecieptStatus[] Returns an array of RecieptStatus objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RecieptStatus
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
