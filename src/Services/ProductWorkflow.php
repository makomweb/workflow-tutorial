<?php

namespace App\Services;

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

    public function canShip(Product $product): bool
    {
        return $this->workflow->can($product, 'ship');
    }

    public function canWrap(Product $product): bool
    {
        return $this->workflow->can($product, 'wrap');
    }

    public function canTest(Product $product): bool
    {
        return $this->workflow->can($product, 'test');
    }

    public function canImplement(Product $product): bool
    {
        return $this->workflow->can($product, 'implement');
    }

    public function ship(Product $product)
    {
        $this->workflow->apply($product, 'ship');
    }

    public function wrap(Product $product)
    {
        $this->workflow->apply($product, 'wrap');
    }

    public function test(Product $product)
    {
        $this->workflow->apply($product, 'test');
    }

    public function implement(Product $product)
    {
        $this->workflow->apply($product, 'implement');
    }
}