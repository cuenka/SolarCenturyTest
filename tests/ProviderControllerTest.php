<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 24/02/19
 * Time: 19:54
 */

namespace App\Tests;

use App\Controller\ProviderController;
use App\Entity\Company;
use App\Entity\Employee;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProviderControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();
        $url = $client->getContainer()->get('router')->generate('provider_list',['type'=> Company::NAME]);

        $client->request('GET', $url);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }


    public function testEdit()
    {
        $client = static::createClient();

        $company = $client->getContainer()->get('doctrine')->getManager()->getRepository(Company::class)->findOneBy([]);
        $url = $client->getContainer()->get('router')->generate('provider_edit', [
            'type'=> Company::NAME, 'id' => $company->getId(), 'name' => 'Solar Century', 'headquarters' => 'London']);

        $crawler = $client->request('PUT', $url);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

    public function testAdd()
    {
        $client = static::createClient();
        $url = $client->getContainer()->get('router')->generate('provider_add', [
            'type'=> Company::NAME, 'name' => 'Solar Century', 'headquarters' => 'London']);

        $crawler = $client->request('GET', $url);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testDelete()
    {
        $client = static::createClient();

        $client->request('GET', '/provider/company/list');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }
}
