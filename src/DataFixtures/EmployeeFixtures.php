<?php

namespace App\DataFixtures;

use App\Entity\Company;
use App\Entity\Employee;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class EmployeeFixtures
 */
class EmployeeFixtures extends Fixture
{
    /**
     * creation of a few company examples for test purposes
     * @return array
     */
    private function getFixtures()
    {
        try {
            $employees = [
                [
                'firstName' => 'John',
                'lastName' => 'Doe',
                ],
                [
                    'firstName' => 'James',
                    'lastName' => 'Garcia',
                ],
                [
                    'firstName' => 'Michael',
                    'lastName' => 'Smith',
                ],
                [
                    'firstName' => 'Maria',
                    'lastName' => 'Hernandez',
                ],
                [
                    'firstName' => 'Susan',
                    'lastName' => 'King',
                ],
                [
                    'firstName' => 'Emily',
                    'lastName' => 'Bell',
                ],
                [
                    'firstName' => 'Emma',
                    'lastName' => 'Doe',
                ]
            ];
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return [];
        }

        return $employees;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $employees = $this->getFixtures();

        foreach ($employees as $employee) {
            $employeeInstance = new Employee();
            // Getting references from Company
            $employeeInstance->setFirstName($employee['firstName'])
                ->setLastName($employee['lastName'])
                ->setCompany($this->getReference(CompanyFixtures::COMPANY. rand(0, 2)));
            $manager->persist($employeeInstance);
        }

        $manager->flush();
    }
}
