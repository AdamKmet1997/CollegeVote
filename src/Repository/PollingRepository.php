<?php

namespace App\Repository;

use App\Entity\Polling;
use App\Entity\Vote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use PhpParser\Node\Scalar\String_;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Polling|null find($id, $lockMode = null, $lockVersion = null)
 * @method Polling|null findOneBy(array $criteria, array $orderBy = null)
 * @method Polling[]    findAll()
 * @method Polling[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PollingRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Polling::class);
    }

     /**
      * @return Polling[] Returns an array of Polling objects
      */

 public function findByExampleField($value)
    {
           $q=$this->createQueryBuilder('p')
            ->leftJoin('p.Voting_id','v')
               ->Select('p.Ans')
            ->where('v.id = :val')
//            ->groupBy('v.id ')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
        return $q;
    }


    /*    public function findOneBySomeField($value): ?Polling
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
