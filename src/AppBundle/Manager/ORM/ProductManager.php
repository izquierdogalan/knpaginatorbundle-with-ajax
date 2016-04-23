<?php

namespace AppBundle\Manager\ORM;

use AppBundle\Entity\Product;
use AppBundle\Manager\ProductManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("app.manager.product")
 */
class ProductManager implements ProductManagerInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * @DI\InjectParams({
     *     "entityManager" = @DI\Inject("doctrine.orm.entity_manager")
     * })
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAllProductsPaginated()
    {
        return $this->entityManager->getRepository(Product::class)->findAllPaginated();
    }
}