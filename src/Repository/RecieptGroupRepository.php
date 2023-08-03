<?php

namespace App\Repository;

use App\Entity\RecieptGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RecieptGroup>
 *
 * @method RecieptGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecieptGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecieptGroup[]    findAll()
 * @method RecieptGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecieptGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecieptGroup::class);
    }

//    /**
//     * @return RecieptGroup[] Returns an array of RecieptGroup objects
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

//    public function findOneBySomeField($value): ?RecieptGroup
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
