<?php

namespace AppBundle\Manager\ORM;

use AppBundle\Manager\ProductManagerInterface;
use AppBundle\Repository\ProductRepositoryInterface;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("app.manager.product")
 */
class ProductManager implements ProductManagerInterface
{
    /** @var ProductRepositoryInterface */
    private $productRepository;

    /**
     * @DI\InjectParams({
     *     "productRepository" = @DI\Inject("app.repository.product")
     * })
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProductsPaginated()
    {
        return $this->productRepository->findAllPaginated();
    }
}