<?php

/*
 * Quentic Platform
 * Copyright(c) Quentic GmbH
 * contact.de@quentic.com
 *
 * https://www.quentic.com
 */

namespace App;


use App\Entity\Product;

class DecoratedProduct
{
    /**
     * @var Product
     */
    private $product;
    /**
     * @var string
     */
    private $transition;

    /**
     * DecoratedProduct constructor.
     * @param Product $product
     * @param string|null $transition
     */
    public function __construct(Product $product,
                                ?string $transition) {

        $this->product = $product;
        $this->transition = $transition;
    }

    public function getId(): int {
        return $this->product->getId();
    }

    public function getName(): string {
        return $this->product->getName();
    }

    public function getStatus(): string {
        return $this->product->getStatus();
    }

    public function getTransition(): ?string {
        return $this->transition;
    }
}