<?php

namespace App\Repository;

use App\Entity\EmpresaMilha;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EmpresaMilha|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmpresaMilha|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmpresaMilha[]    findAll()
 * @method EmpresaMilha[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmpresaMilhaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmpresaMilha::class);
    }

    // /**
    //  * @return EmpresaMilha[] Returns an array of EmpresaMilha objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EmpresaMilha
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
