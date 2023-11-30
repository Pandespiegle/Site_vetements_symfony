<?php

namespace App\Repository;

use App\Entity\Chaussure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Chaussure>
 *
 * @method Chaussure|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chaussure|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chaussure[]    findAll()
 * @method Chaussure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChaussureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chaussure::class);
    }

    public function findAllValues()
    {
        // Use the EntityManager to create a query
        $query = $this->createQueryBuilder('e')
            ->getQuery()
            ->orderBy('e.createdAt', 'DESC');
        // Execute the query and return the results
        return $query->getResult();
    }


    public function findOneBySomeField($value): ?Chaussure
   {
       return $this->createQueryBuilder('v')
           ->andWhere('v.id = :val')
           ->setParameter('val', $value)
           ->getQuery()
           ->getOneOrNullResult()
       ;
   }
//    /**
//     * @return Chaussure[] Returns an array of Chaussure objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Chaussure
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
