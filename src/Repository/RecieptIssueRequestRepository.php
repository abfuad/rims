<?php

namespace App\Repository;

use App\Entity\RecieptIssueRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RecieptIssueRequest>
 *
 * @method RecieptIssueRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecieptIssueRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecieptIssueRequest[]    findAll()
 * @method RecieptIssueRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecieptIssueRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecieptIssueRequest::class);
    }

//    /**
//     * @return RecieptIssueRequest[] Returns an array of RecieptIssueRequest objects
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

//    public function findOneBySomeField($value): ?RecieptIssueRequest
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
