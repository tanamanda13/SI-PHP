<?php

namespace App\Repository;

use App\Entity\RembermeToken;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RembermeToken|null find($id, $lockMode = null, $lockVersion = null)
 * @method RembermeToken|null findOneBy(array $criteria, array $orderBy = null)
 * @method RembermeToken[]    findAll()
 * @method RembermeToken[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RembermeTokenRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RembermeToken::class);
    }

    // /**
    //  * @return RembermeToken[] Returns an array of RembermeToken objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RembermeToken
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
