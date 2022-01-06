<?php

namespace App\Repository;

use App\Entity\RegistroSaida;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RegistroSaida|null find($id, $lockMode = null, $lockVersion = null)
 * @method RegistroSaida|null findOneBy(array $criteria, array $orderBy = null)
 * @method RegistroSaida[]    findAll()
 * @method RegistroSaida[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegistroSaidaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RegistroSaida::class);
    }
}
