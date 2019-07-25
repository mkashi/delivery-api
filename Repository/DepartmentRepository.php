<?php

namespace Delivery\ApiBundle\Repository;

use Delivery\ApiBundle\Entity\Localisation\Department;
use Doctrine\ORM\EntityRepository;

/**
 * Class DepartmentRepository
 */
class DepartmentRepository extends EntityRepository
{
    /**
     * @return Department[]
     */
    public function getDepartments()
    {
        return $this->findBy([], [
            'zip' => 'asc',
        ]);
    }
}