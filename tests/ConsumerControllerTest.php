<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 24/02/19
 * Time: 20:15
 */

namespace App\Controller;

use App\Entity\Company;
use App\Entity\Employee;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class ConsumerControllerTest
 * @package App\Controller
 */
class ConsumerControllerTest extends WebTestCase
{

    public function testIndex()
    {
        $client = static::createClient();
        $url = $client->getContainer()->get('router')->generate('consumer_index');

        $crawler = $client->request('GET', $url);

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Consumer")')->count()
        );
    }

    public function testNewCompany()
    {
        $client = static::createClient();
        $url = $client->getContainer()->get('router')->generate('consumer_add_company');

        $crawler = $client->request('GET', $url);

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("New company")')->count()
        );
    }

    public function testEditCompany()
    {
        $client = static::createClient();
        $company = $client->getContainer()->get('doctrine')->getManager()->getRepository(Company::class)->findOneBy([]);
        $url = $client->getContainer()->get('router')->generate('consumer_edit_company', [
            'company' => $company->getId()]);

        $crawler = $client->request('GET', $url);

        $this->assertGreaterThan(
            0, $company->getId()

//            $crawler->filter('html:contains("Edit")')->count()
        );
    }

    public function testNewEmployee()
    {
        $client = static::createClient();
        $url = $client->getContainer()->get('router')->generate('consumer_add_employee');

        $crawler = $client->request('GET', $url);

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("New")')->count()
        );
    }

    public function testEditEmployee()
    {
        $client = static::createClient();

        $employee = $client->getContainer()->get('doctrine')->getManager()->getRepository(Employee::class)->findOneBy([]);
        $url = $client->getContainer()->get('router')->generate('consumer_edit_employee', [
            'employee' => $employee->getId()]);

        $crawler = $client->request('GET', $url);

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Edit")')->count()
        );
    }

}
