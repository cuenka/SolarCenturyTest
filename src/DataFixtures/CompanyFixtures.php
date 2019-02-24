<?php

namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class CompanyFixtures
 */
class CompanyFixtures extends Fixture
{
    public const COMPANY = 'company';
    /**
     * creation of a few compnay examples for test purposes
     * @return array
     */
    private function getFixtures()
    {
        try {
            $companies = [
                [
                'name' => 'Company A',
                'headquarters' => 'Flat 1, Nice Place, N1 1A1 London, United kingdom',
                'founded' => new \DateTime('-  10 years'),
                'logo' => 'logoA.jpg'
                ],
                [
                    'name' => 'Company B',
                    'headquarters' => 'Flat 10, Great Place, NW1 1B1 London, United kingdom',
                    'founded' => new \DateTime('-  8 years'),
                    'logo' => 'logoB.jpg'
                ],
                [
                    'name' => 'Company C',
                    'headquarters' => 'Flat 20, Awesome Place, NE2 2B1 London, United kingdom',
                    'founded' => new \DateTime('-  3 years'),
                    'logo' => 'logoC.jpg'
                ]
            ];
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return [];
        }

        return $companies;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $companies = $this->getFixtures();

        foreach ($companies as $key => $company) {
            $companyInstance = new Company();
            $companyInstance->setName($company['name'])
                ->setHeadquarters($company['headquarters'])
                ->setFounded($company['founded'])
                ->setLogo($company['logo']);
            $manager->persist($companyInstance);

            // These references will be used when staff is created
            $this->addReference(self::COMPANY.$key, $companyInstance);
        }

        $manager->flush();
    }
}
