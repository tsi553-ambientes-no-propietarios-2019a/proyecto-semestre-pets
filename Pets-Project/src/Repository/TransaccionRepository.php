<?php

namespace App\Repository;

use App\Entity\Transaccion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Transaccion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Transaccion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Transaccion[]    findAll()
 * @method Transaccion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransaccionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Transaccion::class);
    }

    /**
     * @return Transaccion[] Returns an array of Transaccion objects
     */
    
    public function findUser($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.id = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Transaccion
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
