<?php

namespace App\Repository;

use App\Entity\Dish;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Dish>
 *
 * @method Dish|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dish|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dish[]    findAll()
 * @method Dish[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DishRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dish::class);
    }

    public function save(Dish $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Dish $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Select the 6 last favorite dishes
     * @param int $limit
     * @return Dish[] Returns an array of Dish objects
     */
    public function findFavoriteDishes(int $limit): array
    {
        $value = 1;
        $qb = $this->createQueryBuilder('d')
            ->andWhere('d.favorite = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'DESC')
            ->setMaxResults($limit)
        ;
        $query = $qb->getQuery();
        return $query->getResult();
    }

    /**
     * Select all the dishes by ascending price
     * @return array
     */
    public function findDishesByAscendingPrice(): array
    {
        $qb = $this->createQueryBuilder('d')
            ->orderBy('d.price', 'ASC')
        ;
        $query = $qb->getQuery();
        return $query->getResult();
    }

    /**
     * Select the dishes by category and setmenu
     * @param string $category
     * @param int $setmenu
     * @return array
     */
//    public function findDishesByCategory(string $category, int $setmenu): array
//    {
//        return $this->getEntityManager()->createQuery(
//            'SELECT DISTINCT d FROM App\Entity\Dish d
//                JOIN d.category c
//                JOIN d.setmenus s
//                WHERE c.title = :category AND s.id = :setmenus
//                ORDER BY d.price ASC'
//        )
//            ->setParameter('category', $category)
//            ->setParameter('setmenus', $setmenu)
//            ->getResult();
//    }

    public function findDishesByCategory(string $category, string $setmenu): array
    {
        return $this->getEntityManager()->createQuery(
            'SELECT DISTINCT d FROM App\Entity\Dish d
                JOIN d.category c
                JOIN d.setmenus s
                WHERE c.title = :category AND s.title LIKE :setmenus 
                ORDER BY d.price ASC'
        )
            ->setParameter('category', $category)
            ->setParameter('setmenus', '%'. $setmenu. '%')
            ->getResult();
    }

//    /**
//     * @return Dish[] Returns an array of Dish objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Dish
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
