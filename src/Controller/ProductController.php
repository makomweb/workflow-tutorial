<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Services\ProductResponseFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @var ProductRepository
     */
    private $repository;
    /**
     * @var ProductResponseRepository
     */
    private $responseFactory;

    public function __construct(ProductRepository $repository, ProductResponseFactory $responseFactory)
    {
        $this->repository = $repository;
        $this->responseFactory = $responseFactory;
    }

    /**
     * @Route("/list", name="list", methods={"GET"})
     */
    public function index(): JsonResponse
    {
        $products = $this->repository->findAll();
        return $this->responseFactory->createFromProducts($products);
    }

    /**
     * @Route("/create", name="create", methods={"GET"})
     */
    public function create(): JsonResponse
    {
        $product = new Product();
        $product->setName("Foobar");

        $this->repository->save($product);
        return $this->responseFactory->createFromProduct($product);
    }
}