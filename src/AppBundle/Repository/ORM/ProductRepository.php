<?php

namespace AppBundle\Repository\ORM;

use AppBundle\Entity\Product;
use AppBundle\Repository\ProductRepositoryInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("app.repository.product")
 */
class ProductRepository extends EntityRepository implements ProductRepositoryInterface
{
    /**
     * @DI\InjectParams({
     *     "em" = @DI\Inject("doctrine.orm.entity_manager"),
     *     "class" = @DI\Inject(Product::class)
     * })
     */
    public function __construct(EntityManager $em)
    {
        parent::__construct($em, new Mapping\ClassMetadata(Product::class));
    }

    public function findAllPaginated()
    {
        dump($this);
        return $this->createQueryBuilder('p')
            ->orderBy('p.name', 'ASC');
    }
}