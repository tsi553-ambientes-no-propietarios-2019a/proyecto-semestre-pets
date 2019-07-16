<?php

namespace App\Repository;

use App\Entity\Anfitrion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Anfitrion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Anfitrion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Anfitrion[]    findAll()
 * @method Anfitrion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnfitrionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Anfitrion::class);
    }

    // /**
    //  * @return Anfitrion[] Returns an array of Anfitrion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Anfitrion
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
