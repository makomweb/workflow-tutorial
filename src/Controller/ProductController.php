<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/list", name="list", methods={"GET"})
     */
    public function index(): Response
    {
        $products = $this->repository->findAll();
        return $this->json($products);
    }

    /**
     * @Route("/create", name="create", methods={"GET"})
     */
    public function create(): Response
    {
        $product = new Product();
        $product->setName("Foobar");

        $this->repository->save($product);

        return $this->json($product);
    }
}
