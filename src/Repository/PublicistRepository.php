<?php

namespace App\Repository;

use App\Entity\Publicist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Publicist|null find($id, $lockMode = null, $lockVersion = null)
 * @method Publicist|null findOneBy(array $criteria, array $orderBy = null)
 * @method Publicist[]    findAll()
 * @method Publicist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PublicistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Publicist::class);
    }

}
