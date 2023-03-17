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


//    /**
//     * https://www.doctrine-project.org/projects/doctrine-orm/en/2.14/reference/dql-doctrine-query-language.html#update-queries
//     * @param array $openinghours
//     * @return int|mixed|string
//     */
//    public function addHours(array $openinghours)
//    {
//        return $this->getEntityManager()->createQuery(
//            'UPDATE App\Entity\Openingday d
//                SET d.openinghours = :openinghours'
//        )
//            ->setParameter('openinghours', $openinghours)
//            ->getResult();
//    }

    /**
     * @param int $open
     * @param $id
     * @return int|mixed|string
     */
    public function updateOpen(int $open, $id)
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

    // TEST EN COURS
    public function findDayByName(string $day): array
    {
        return $this->getEntityManager()->createQuery(
            'SELECT o.day FROM App\Entity\Openingday o
                JOIN o.openingshours h
                WHERE o.day = :day
                '
        )
            ->setParameter('day', $day)
            ->getResult() ;
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
