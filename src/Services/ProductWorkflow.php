<?php

namespace App\Services;

use App\Entity\Product;
use Exception;
use Symfony\Component\Workflow\WorkflowInterface;

class ProductWorkflow
{
    /**
     * @var WorkflowInterface
     */
    private $workflow;

    public function __construct(WorkflowInterface $workflow)
    {
        $this->workflow = $workflow;
    }

    private function ship(Product $product)
    {
        $this->workflow->apply($product, 'ship');
    }

    private function wrap(Product $product)
    {
        $this->workflow->apply($product, 'wrap');
    }

    private function test(Product $product)
    {
        $this->workflow->apply($product, 'test');
    }

    private function implement(Product $product)
    {
        $this->workflow->apply($product, 'implement');
    }

    public function setNext(Product $product)
    {
        switch ($product->getStatus())
        {
            case 'prototyped': $this->implement($product); break;
            case 'implemented': $this->test($product); break;
            case 'tested': $this->wrap($product); break;
            case 'wrapped': $this->ship($product); break;
            default: throw new Exception('There is no next status after: ' . $product->getStatus() . '!');
        }
    }
}