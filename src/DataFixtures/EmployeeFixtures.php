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
                'photo' => 'staffA.jpg'
                ],
                [
                    'firstName' => 'James',
                    'lastName' => 'Garcia',
                    'photo' => 'staffB.jpg'
                ],
                [
                    'firstName' => 'Michael',
                    'lastName' => 'Smith',
                    'photo' => 'staffC.jpg'
                ],
                [
                    'firstName' => 'Maria',
                    'lastName' => 'Hernandez',
                    'photo' => 'staffD.jpg'
                ],
                [
                    'firstName' => 'Susan',
                    'lastName' => 'King',
                    'photo' => 'staffE.jpg'
                ],
                [
                    'firstName' => 'Emily',
                    'lastName' => 'Bell',
                    'photo' => 'staffF.jpg'
                ],
                [
                    'firstName' => 'Emma',
                    'lastName' => 'Doe',
                    'photo' => 'staffG.jpg'
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
                ->setPhoto($employee['photo'])
                ->setCompany($this->getReference(CompanyFixtures::COMPANY. rand(0, 2)));
            $manager->persist($employeeInstance);
        }

        $manager->flush();
    }
}
