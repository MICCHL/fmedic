<?php

namespace App\Repository;

use App\Entity\Doctor;
use App\Entity\User;
use App\Entity\Visit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Visit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Visit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Visit[]    findAll()
 * @method Visit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Visit::class);
    }

    /**
     * @return Visit[] Returns an array of Visit objects
     */
    public function findBookedVisits(Doctor $doctor, \DateTimeImmutable $startAt, \DateTimeImmutable $endAt)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.doctor = :doctor')
            ->setParameter('doctor', $doctor)
            ->andWhere('v.date BETWEEN :startDate AND :endDate')
            ->setParameter('startDate', $startAt)
            ->setParameter('endDate', $endAt)
            ->getQuery()
            ->getResult();
    }

    public function findUserVisit(User  $user)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.patient = :patient')
            ->setParameter('patient', $user)
            ->orderBy('v.date')
            ->orderBy('v.status')
            ->getQuery()
            ->getResult();
    }

    public function findDoctorVisit(User  $user)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.status = :status')
            ->setParameter('status', 0)
            ->andWhere('v.date BETWEEN :startDate AND :endDate')
            ->setParameter('startDate', date('Y-m-d 00:00:00'))
            ->setParameter('endDate', date('Y-m-d 23:59:59'))
            ->join('v.doctor', 'd')
            ->andWhere('d.user = :user')
            ->setParameter('user', $user)
            ->orderBy('v.date')
            ->getQuery()
            ->getResult();
    }

}
