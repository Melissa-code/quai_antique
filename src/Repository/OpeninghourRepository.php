<?php

namespace App\Repository;

use App\Entity\Openinghour;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Openinghour>
 *
 * @method Openinghour|null find($id, $lockMode = null, $lockVersion = null)
 * @method Openinghour|null findOneBy(array $criteria, array $orderBy = null)
 * @method Openinghour[]    findAll()
 * @method Openinghour[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OpeninghourRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Openinghour::class);
    }

    public function save(Openinghour $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Openinghour $entity, bool $flush = false): void
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
            ->orderBy(' o.starthour', 'ASC')
            ->getQuery();
    }

    /**
     * Find all the opening hours in ascending start hour order
     * @return array (hours)
     */
    public function findAllByAscendingHours(): array
    {
        return $this->createQueryBuilder('o')
            ->orderBy(' o.starthour', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Find the opening hour for the startAt of a booking
     * @param string $startAt
     * @param string $openingDay
     * @return Openinghour|null
     * @throws NonUniqueResultException
     */
    public function findOneByHours(string $startAt, string $openingDay): ?Openinghour
    {
        return $this->getEntityManager()->createQuery(
            'SELECT DISTINCT o FROM App\Entity\OpeningHour o             
                JOIN o.openingdays d
                WHERE d.day = :openingDay AND o.starthour < :startAt and o.endhour > :startAt'
        )
            ->setParameter('startAt', $startAt)
            ->setParameter('openingDay', $openingDay)
            ->getOneOrNullResult();
    }



//    /**
//     * @return Openinghour[] Returns an array of Openinghour objects
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

//    public function findOneBySomeField($value): ?Openinghour
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
