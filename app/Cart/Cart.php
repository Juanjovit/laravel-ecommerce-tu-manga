<?php

namespace App\Cart;


use App\Models\Manga;

class Cart  
{
    private array $items = [];

    public function addItem(CartItem $newItem)
    {
        foreach($this->items as $item) {
            if($item->getId() === $newItem->getId()) {
                $item->increaseQuantity();
                return;
            }
        }

        $this->items[] = $newItem; 
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getItem(int $id)
    {
        foreach($this->items as $item) {
            if($item->getId() === $id) {
                return $item;
            }
        }
    }

    public function setQuantity(int $id, int $quantity): void
    {
        $this->getItem($id)->setQuantity($quantity);
    }

    public function increaseQuantity(int $id, int $quantity = 1): void
    {
        $this->getItem($id)->increaseQuantity($quantity);
    }

    public function decreaseQuantity(int $id, int $quantity = 1)
    {
        $this->getItem($id)->decreaseQuantity($quantity);
    }

    public function removeItem(int $id)
    {
        foreach($this->items as $key => $item) {
            if($item->getId() === $id) {
                unset($this->items[$key]);
             
                $this->items = array_values($this->items);

                return;
            }
        }
    }
    
    public function getTotal(): int|float
    {
        $total = 0;

        foreach($this->items as $item) {
            $total += $item->getSubtotal();
        }

        return $total;
    }

    public function isEmpty()
    {
        return count($this->items) === 0;
    }
}
