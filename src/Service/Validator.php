<?php
/**
 * Created by PhpStorm.
 * User: jose
 * Date: 24/02/19
 * Time: 15:21
 */

namespace App\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class Validator
 * @package App\Service
 */
abstract class Validator implements ValidatorInterface
{
    /**
     * @param array $parameters
     * @return array|null
     */
    abstract public function validateRequest(array $parameters) :? array;
}
