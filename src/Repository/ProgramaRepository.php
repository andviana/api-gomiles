<?php

namespace App\Repository;

use App\Entity\Programa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Programa|null find($id, $lockMode = null, $lockVersion = null)
 * @method Programa|null findOneBy(array $criteria, array $orderBy = null)
 * @method Programa[]    findAll()
 * @method Programa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgramaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Programa::class);
    }
}
