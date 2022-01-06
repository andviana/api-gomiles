<?php

namespace App\Repository;

use App\Entity\RegistroEntrada;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RegistroEntrada|null find($id, $lockMode = null, $lockVersion = null)
 * @method RegistroEntrada|null findOneBy(array $criteria, array $orderBy = null)
 * @method RegistroEntrada[]    findAll()
 * @method RegistroEntrada[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegistroEntradaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RegistroEntrada::class);
    }
}
