<?php

namespace App\Service;

use App\Entity\Company;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class Validator
 * @package App\Service
 */
class RequestValidator extends Validator
{
    /**
     * @param array $parameters
     * @return array|null
     * @throws \Exception
     */
    public function validateRequest(array $parameters) :? array
    {
        $cleanParameters['name'] = (isset($parameters['name']) ? $parameters['name'] : null);
        $cleanParameters['headquarters'] = (isset($parameters['headquarters']) ? $parameters['headquarters'] : null);
        $cleanParameters['founded'] = (isset($parameters['founded']) ? new \DateTime($parameters['founded']) : null);
        $cleanParameters['firstName'] = (isset($parameters['firstName']) ? $parameters['firstName'] : null);
        $cleanParameters['LastName'] = (isset($parameters['LastName']) ? $parameters['LastName'] : null);

        return $cleanParameters;
    }
}
