<?php

namespace App\Repository;

use App\Entity\PagoCliente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PagoCliente|null find($id, $lockMode = null, $lockVersion = null)
 * @method PagoCliente|null findOneBy(array $criteria, array $orderBy = null)
 * @method PagoCliente[]    findAll()
 * @method PagoCliente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PagoClienteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PagoCliente::class);
    }

    // /**
    //  * @return PagoCliente[] Returns an array of PagoCliente objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PagoCliente
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
