<?php

namespace App\Repository;

use App\Entity\Doctor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Doctor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Doctor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Doctor[]    findAll()
 * @method Doctor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Doctor::class);
    }

    /**
     * @return Doctor[] Returns an array of User objects
     */
    public function findDoctorWorkToday()
    {
        $dayName = strtolower(date('l'));

        return $this->createQueryBuilder('d')
            ->andWhere('t.'.$dayName.' = 1')
            ->join('d.timetable', 't')
            ->getQuery()
            ->getResult();
    }

}
