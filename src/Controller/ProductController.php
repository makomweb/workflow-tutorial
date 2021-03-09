<?php

namespace App\Controller;

use App\DataFixtures\SampleProducts;
use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Services\JsonResponseFactory;
use App\Services\ProductWorkflow;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
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
    /**
     * @var ProductWorkflow
     */
    private $workflow;

    public function __construct(ProductRepository $repository,
                                JsonResponseFactory $responseFactory,
                                ProductWorkflow $workflow)
    {
        $this->repository = $repository;
        $this->responseFactory = $responseFactory;
        $this->workflow = $workflow;
    }

    /**
     * @Route("/index", name="index", methods={"GET"})
     */
    public function index(): JsonResponse
    {
        $products = $this->repository->findAll();
        return $this->responseFactory->createFromObjects($products);
    }

    /**
     * @Route("/create", name="create", methods={"GET"})
     */
    public function create(): Response
    {
        $products = SampleProducts::getSampleProducts();

        foreach ($products as $product)
        {
            $this->repository->save($product);
        }

        return $this->redirectToRoute('view');
    }

    /**
     * @Route("/view", name="view", methods={"GET"})
     */
    public function view() : Response
    {
        $products = $this->repository->findAll();

        return $this->render('Product/index.html.twig', [
            'products' => $products,
        ]);
    }


    /**
     * @Route("/view-product/{id}", name="view_product", methods={"GET"})
     * @param $id
     * @return Response
     */
    public function viewProduct($id) : Response{

        $product = $this->repository->find($id);

        if (!$product) {
            throw $this->createNotFoundException('No product found for id ' . $id);
        }

        return $this->render('Product/view-product.html.twig',
            [
                'product' => $product
            ]);
    }

    /**
     * @Route ("/next/{id}", name="next", methods={"GET"})
     * @param $id
     * @return Response
     */
    public function next($id): Response
    {
        $product = $this->repository->find($id);

        if (!$product) {
            throw $this->createNotFoundException('No product found for id ' . $id);
        }

        $this->workflow->setNext($product);
        $this->repository->save($product);

        return $this->redirectToRoute('view');
    }
}