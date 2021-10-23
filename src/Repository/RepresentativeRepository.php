<?php

namespace App\Repository;

use App\Entity\Representative;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Representative|null find($id, $lockMode = null, $lockVersion = null)
 * @method Representative|null findOneBy(array $criteria, array $orderBy = null)
 * @method Representative[]    findAll()
 * @method Representative[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RepresentativeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Representative::class);
    }

}
