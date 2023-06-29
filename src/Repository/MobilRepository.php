<?php

namespace App\Repository;

use App\Entity\Mobil;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Mobil>
 *
 * @method Mobil|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mobil|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mobil[]    findAll()
 * @method Mobil[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MobilRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mobil::class);
    }

    public function save(Mobil $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Mobil $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    // public function findMobil(?string $modele, ?Mobil $mobil): array
    // {
    //     $queryBuilder = $this->createQueryBuilder('p');

    //     if ($modele) {
    //         $queryBuilder->where('p.title LIKE :modele');
    //         $queryBuilder->setParameter('modele', '%' . $modele . '%');
    //     }

    //     if ($mobil) {
    //         $queryBuilder->andWhere('p.mobil = :mobil');
    //         $queryBuilder->setParameter('mobil', $mobil);
    //     }
    //     $queryBuilder->orderBy('p.model', 'ASC');

    //     return $queryBuilder->getQuery()->getResult();
    // }

    public function findMobil($search)
    {
        $queryBuilder = $this->createQueryBuilder('m')
            ->where('m.modele = :search')
            ->setParameter('search', $search);

        return $queryBuilder->getQuery()->getResult();
    }
    //    /**
    //     * @return Mobil[] Returns an array of Mobil objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Mobil
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
