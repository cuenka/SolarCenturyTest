<?php

namespace App\Service;

/**
 * Interface of Validator in services folder but I was think creating folder "Interface" but for this test it is OK
 * Interface ValidatorInterface
 * @package App\Service
 */
interface ValidatorInterface
{
    /**
     * @param array $parameters
     * @return array|null
     */
    public function validateRequest(array $parameters) :? array;
}
