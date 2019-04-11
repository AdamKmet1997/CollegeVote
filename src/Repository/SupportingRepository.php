<?php

namespace App\Repository;

use App\Entity\Supporting;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Supporting|null find($id, $lockMode = null, $lockVersion = null)
 * @method Supporting|null findOneBy(array $criteria, array $orderBy = null)
 * @method Supporting[]    findAll()
 * @method Supporting[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SupportingRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Supporting::class);
    }

    // /**
    //  * @return Supporting[] Returns an array of Supporting objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Supporting
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
