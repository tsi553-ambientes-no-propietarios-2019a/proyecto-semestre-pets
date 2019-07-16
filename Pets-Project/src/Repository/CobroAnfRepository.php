<?php

namespace App\Repository;

use App\Entity\CobroAnf;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CobroAnf|null find($id, $lockMode = null, $lockVersion = null)
 * @method CobroAnf|null findOneBy(array $criteria, array $orderBy = null)
 * @method CobroAnf[]    findAll()
 * @method CobroAnf[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CobroAnfRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CobroAnf::class);
    }

    // /**
    //  * @return CobroAnf[] Returns an array of CobroAnf objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CobroAnf
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
