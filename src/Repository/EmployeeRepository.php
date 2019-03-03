<?php

namespace App\Repository;

use App\Entity\Employee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Employee|null find($id, $lockMode = null, $lockVersion = null)
 * @method Employee|null findOneBy(array $criteria, array $orderBy = null)
 * @method Employee[]    findAll()
 * @method Employee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployeeRepository extends ServiceEntityRepository
{
    /**
     * EmployeeRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Employee::class);
    }

    /**
     * Return all employees as array so it is easier to display
     * @return array
     */
    public function findAllEmployeesAsArray()
    {
        return $this->createQueryBuilder('e')
            ->getQuery()
            ->getArrayResult();

    }

    /**
     * @param $company
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findByCompany($company)
    {
        return $this->createQueryBuilder('e')
            ->select('e.id, e.firstName, e.lastName, c.name, c.headquarters')
            ->leftJoin('App\Entity\Company', 'c', \Doctrine\ORM\Query\Expr\Join::WITH, 'e.company = c.id')
            ->setMaxResults(20)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $value
     * @return mixed
     */
    public function findByLastName($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.lastName = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }


    /**
     * @param $value
     * @return Employee|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneName($value): ?Employee
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.firstName = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
