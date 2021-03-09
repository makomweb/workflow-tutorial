<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class JsonResponseFactory
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * JsonResponseFactory constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer) {

        $this->serializer = $serializer;
    }

    /**
     * @param $object
     * @return JsonResponse
     */
    public function createFromObject($object): JsonResponse
    {
        $data = $this->serializer->serialize($object, JsonEncoder::FORMAT);
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    /**
     * @param array $objects
     * @return JsonResponse
     */
    public function createFromObjects(array $objects): JsonResponse
    {
        $data = $this->serializer->serialize($objects, JsonEncoder::FORMAT);
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}
