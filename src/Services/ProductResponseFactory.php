<?php

/*
 * Quentic Platform
 * Copyright(c) Quentic GmbH
 * contact.de@quentic.com
 *
 * https://www.quentic.com
 */

namespace App\Services;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class ProductResponseFactory
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * ProductResponseFactory constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer) {

        $this->serializer = $serializer;
    }
    /**
     * @param Product $product
     * @return JsonResponse
     */
    public function createFromProduct(Product $product): JsonResponse
    {
        $data = $this->serializer->serialize($product, JsonEncoder::FORMAT);
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    /**
     * @param Product[] $products
     * @return JsonResponse
     */
    public function createFromProducts(array $products): JsonResponse
    {
        $data = $this->serializer->serialize($products, JsonEncoder::FORMAT);
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}
