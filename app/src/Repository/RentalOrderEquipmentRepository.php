<?php

namespace App\Repository;

use App\Entity\RentalOrderEquipment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RentalOrderEquipment>
 *
 * @method RentalOrderEquipment|null find($id, $lockMode = null, $lockVersion = null)
 * @method RentalOrderEquipment|null findOneBy(array $criteria, array $orderBy = null)
 * @method RentalOrderEquipment[]    findAll()
 * @method RentalOrderEquipment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RentalOrderEquipmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RentalOrderEquipment::class);
    }

    public function add(RentalOrderEquipment $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RentalOrderEquipment $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return RentalOrderEquipment[] Returns an array of RentalOrderEquipment objects
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

//    public function findOneBySomeField($value): ?RentalOrderEquipment
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
