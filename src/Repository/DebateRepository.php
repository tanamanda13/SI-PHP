<?php

namespace App\Repository;

use App\Entity\Debate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Debate|null find($id, $lockMode = null, $lockVersion = null)
 * @method Debate|null findOneBy(array $criteria, array $orderBy = null)
 * @method Debate[]    findAll()
 * @method Debate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DebateRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Debate::class);
    }

    // /**
    //  * @return Query
    //  */
    public function findAllQuery($orderParam)
    {
        // automatically knows to select Products
        // the "p" is an alias you'll use in the rest of the query
        $qb = $this->createQueryBuilder('p')
            ->orderBy('p.'.$orderParam, 'DESC')
            ->getQuery();

        return $qb;
    }
    
    public function findByAuthor($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.author = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    } 
    public function findByCategory($value, $order)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.category = :val')
            ->setParameter('val', $value)
            ->orderBy('d.'.$order, 'DESC')
            ->getQuery()
        ;
    }

    public function findLikeTitle($search)
    {
        return $this->createQueryBuilder('debate')
                ->andWhere('debate.title LIKE :search OR debate.author LIKE :search')
                ->setParameter('search', '%' . $search . '%')
                ->getQuery()
                ->getResult()
            ;        
    }

    public function findById($id)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Debate
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
