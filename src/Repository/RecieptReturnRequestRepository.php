<?php

namespace App\Repository;

use App\Entity\RecieptReturnRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RecieptReturnRequest>
 *
 * @method RecieptReturnRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecieptReturnRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecieptReturnRequest[]    findAll()
 * @method RecieptReturnRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecieptReturnRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecieptReturnRequest::class);
    }

//    /**
//     * @return RecieptReturnRequest[] Returns an array of RecieptReturnRequest objects
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

//    public function findOneBySomeField($value): ?RecieptReturnRequest
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
