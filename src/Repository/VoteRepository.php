<?php

namespace App\Repository;

use App\Entity\Comment;
use App\Entity\Vote;
use App\Entity\Polling;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\DBAL\DriverManager;

/**
 * @method Vote|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vote|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vote[]    findAll()
 * @method Vote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Vote::class);
    }
    public function findByCountFor($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
            ;
    }
    /**
     * @return Vote[] Returns an array of Polling objects
     */
    public function findByExampleField()
    {
        $q=$this->createQueryBuilder('v')
            ->Select('v')
            ->join(Polling::CLass,'p')
            ->where('v.id = p.Voting_id')
            ->getQuery()
            ->getResult()
        ;
        return count($q);
    }
    /**
     * @return Vote[] Returns an array of Polling objects
     */
    public function showComment($value)
    {
        $q=$this->createQueryBuilder('v')
            ->join(Comment::CLass,'c')
            ->Select('c.Comment')
            ->where('v.id  = c.VoteID')
            ->andWhere('v.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
        return $q;
    }
    public function timer($value){
        $q=$this->createQueryBuilder('v')
            ->Select('v.datetime')
            ->where('v.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
        return $q;
    }



    /*
    public function findOneBySomeField($value): ?Vote
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
