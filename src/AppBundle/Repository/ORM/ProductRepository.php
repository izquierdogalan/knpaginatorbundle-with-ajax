<?php

namespace AppBundle\Repository\ORM;

use AppBundle\Repository\ProductRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository implements ProductRepositoryInterface
{
    public function findAllPaginated()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.name', 'ASC');
    }
}