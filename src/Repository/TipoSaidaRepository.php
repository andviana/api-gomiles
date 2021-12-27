<?php

namespace App\Repository;

use App\Entity\TipoSaida;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoSaida|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoSaida|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoSaida[]    findAll()
 * @method TipoSaida[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoSaidaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoSaida::class);
    }

    // /**
    //  * @return TipoSaida[] Returns an array of TipoSaida objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TipoSaida
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
