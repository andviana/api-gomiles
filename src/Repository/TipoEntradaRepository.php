<?php

namespace App\Repository;

use App\Entity\TipoEntrada;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TipoEntrada|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoEntrada|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoEntrada[]    findAll()
 * @method TipoEntrada[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoEntradaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoEntrada::class);
    }
}
