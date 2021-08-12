<?php

namespace App\Repository;

use App\Entity\Timetable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Timetable|null find($id, $lockMode = null, $lockVersion = null)
 * @method Timetable|null findOneBy(array $criteria, array $orderBy = null)
 * @method Timetable[]    findAll()
 * @method Timetable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TimetableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Timetable::class);
    }

}