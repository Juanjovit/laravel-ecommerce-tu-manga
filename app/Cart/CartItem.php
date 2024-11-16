<?php

namespace App\Cart;


use App\Models\Manga;

class CartItem
{
    public function __construct(
        private Manga $product,
        private int $quantity = 1
    )
    {}

    public function getProduct(): Manga
    {
        return $this->product;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function increaseQuantity(int $quantity = 1): void
    {
        $this->quantity += $quantity;
    }

    public function decreaseQuantity(int $quantity = 1): void
    {
        $this->quantity -= $quantity;
    }

    public function getSubtotal(): int
    {
        $expectedSubtotal = 105000 * 3;

        return $this->getPrice() * $this->quantity;
    }

    public function getId(): int
    {
        return $this->getProduct()->id;
    } 

    public function getPrice(): int
    {
        return $this->getProduct()->price;
    }
}
