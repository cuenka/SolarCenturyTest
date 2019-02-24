<?php

namespace App\Tests;

use App\Service\RequestValidator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class RequestValidatorTest
 * @package App\Tests
 */
class RequestValidatorTest extends WebTestCase
{
    public function testValidateRequest()
    {
        self::bootKernel();

        // returns the real and unchanged service container
        $container = self::$kernel->getContainer();
        $reqValidator = $container->get('app.service.request_validator');
        $reqValidator->validateRequest([]);

        $this->assertArrayHasKey('name', $reqValidator->validateRequest([]));

    }
}
