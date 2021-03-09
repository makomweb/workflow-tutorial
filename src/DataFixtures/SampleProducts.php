<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SampleProducts extends Fixture
{
    public static function getSampleProducts() : array
    {
        $array = array();

        {
            $product = new Product();
            $product->setName("ABC");
            array_push($array, $product);
        }

        {
            $product = new Product();
            $product->setName("XYZ");
            array_push($array, $product);
        }

        {
            $product = new Product();
            $product->setName("123");
            array_push($array, $product);
        }

        return $array;
    }

    public function load(ObjectManager $manager)
    {
        $products = static::getSampleProducts();

        foreach ($products as $product) {
            $manager->persist($product);
        }

        $manager->flush();
    }
}