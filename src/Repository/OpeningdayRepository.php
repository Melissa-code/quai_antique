<?php

namespace App\Repository;

use App\Entity\Openingday;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Openingday>
 *
 * @method Openingday|null find($id, $lockMode = null, $lockVersion = null)
 * @method Openingday|null findOneBy(array $criteria, array $orderBy = null)
 * @method Openingday[]    findAll()
 * @method Openingday[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OpeningdayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Openingday::class);
    }

    public function save(Openingday $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Openingday $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Pagination
     * @return Query
     */
    public function findAllWithPagination() : Query
    {
        return $this->createQueryBuilder('o')
            ->getQuery();
    }

    /**
     * Change the value of open of a day if their hours are updating
     * @param int $open
     * @param $id
     * @return int|string
     */
    public function updateOpen(int $open, $id): int|string
    {
        return $this->getEntityManager()->createQuery(
            'UPDATE App\Entity\Openingday o            
                SET o.open = :open           
                WHERE o.id = :id'
        )
            ->setParameter('open', $open)
            ->setParameter('id', $id)
            ->getResult();
    }


//    /**
//     * @return Openingday[] Returns an array of Openingday objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Openingday
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
