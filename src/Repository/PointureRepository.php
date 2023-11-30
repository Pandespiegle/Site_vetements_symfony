<?php

namespace App\Repository;

use App\Entity\Pointure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pointure>
 *
 * @method Pointure|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pointure|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pointure[]    findAll()
 * @method Pointure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PointureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pointure::class);
    }

    public function findAllValues()
    {
        // Use the EntityManager to create a query
        $query = $this->createQueryBuilder('e')
            ->getQuery();
        // Execute the query and return the results
        return $query->getResult();
    }

//    /**
//     * @return Pointure[] Returns an array of Pointure objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Pointure
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
