<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SampleProducts extends Fixture
{
    public function load(ObjectManager $manager)
    {
        {
            $product = new Product();
            $product->setName("ABC");
            $manager->persist($product);
        }
        {
            $product = new Product();
            $product->setName("XYZ");
            $manager->persist($product);
        }
        {
            $product = new Product();
            $product->setName("123");
            $manager->persist($product);
        }

        $manager->flush();
    }
}