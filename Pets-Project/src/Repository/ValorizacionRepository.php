<?php

namespace App\Repository;

use App\Entity\Valorizacion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Valorizacion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Valorizacion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Valorizacion[]    findAll()
 * @method Valorizacion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ValorizacionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Valorizacion::class);
    }

    // /**
    //  * @return Valorizacion[] Returns an array of Valorizacion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Valorizacion
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
