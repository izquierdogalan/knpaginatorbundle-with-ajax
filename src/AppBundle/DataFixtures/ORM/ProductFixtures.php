<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Product;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Generator;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    const PRODUCTS_NUMBER = 100;

    /** @var ContainerInterface */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        /** @var Generator $fakerGenerator */
        $fakerGenerator = $this->container->get('faker.generator');

        for ($i = 0; $i < self::PRODUCTS_NUMBER; $i++) {
            $product = new Product();
            $product->setName($fakerGenerator->text(30));
            $product->setDescription($fakerGenerator->text(200));
            $product->setPrice($fakerGenerator->randomFloat(2, 0, 100));

            $manager->persist($product);
        }

        $manager->flush();
    }
}