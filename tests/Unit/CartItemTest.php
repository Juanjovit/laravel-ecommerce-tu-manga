<?php

namespace Tests\Unit;

use App\Cart\CartItem;
use App\Models\Manga;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;


class CartItemTest extends TestCase
{

    public function createManga(int $id = 1, int $price = 105000): Manga
    {
        $manga = new Manga();
        $manga->id = 1;
        $manga->price = 105000;
        return $manga;
    }

    public function test_can_instantiate_a_cartitem_with_a_default_quantity_of_1(): CartITem
    {
        $id = 1;
        $price = 105000;
        $manga = $this->createManga($id, $price);


        $item = new \App\Cart\CartItem($manga);

        $this->assertInstanceOf(\App\Cart\CartItem::class, $item);
        $this->assertSame($manga, $item->getProduct());
        $this->assertSame($id, $item->getId());
        $this->assertSame($price, $item->getPrice());
        $this->assertSame(1, $item->getQuantity());

        return $item;
    }


    public function test_can_instantiate_a_cartitem_with_a_custom_quantity(): void
    {
        $quantity = 5;

        $item = new CartItem($this->createManga(), $quantity);

        $this->assertSame($quantity, $item->getQuantity());
    }

    public function test_can_set_the_quantity_of_a_cartitem()
    {
        $item = new CartItem($this->createManga());

        $quantity = 3;

        $item->setQuantity($quantity);

        $this->assertSame($quantity, $item->getQuantity());
    }

    #[Depends('test_can_instantiate_a_cartitem_with_a_default_quantity_of_1')]
    public function test_can_increase_a_cartitem_quantity_by_a_default_of_1(CartItem $item): CartItem
    {

        $item->increaseQuantity();

        $this->assertSame(2, $item->getQuantity());

        return $item;
    }

    #[Depends('test_can_increase_a_cartitem_quantity_by_a_default_of_1')]
    public function test_can_increase_a_cartitem_quantity_by_a_custom_quantity(CartItem $item)
    {
        $item->increaseQuantity(3);

        $this->assertSame(5, $item->getQuantity());

        return $item;
    }

    #[Depends('test_can_increase_a_cartitem_quantity_by_a_custom_quantity')]
    public function test_can_decrease_a_cartitem_quantity_by_a_default_of_1(CartItem $item): CartItem
    {
        $item->decreaseQuantity();

        $this->assertSame(4, $item->getQuantity());

        return $item;
    }

    #[Depends('test_can_decrease_a_cartitem_quantity_by_a_default_of_1')]
    public function test_can_decrease_a_cartitem_quantity_by_a_custom_quantity(CartItem $item)
    {
        $item->decreaseQuantity(3);

        $this->assertSame(1, $item->getQuantity());
    }

    public function test_can_get_the_cartitem_subtotal()
    {
        $expectedSubtotal = 105000 * 3;

        $item = new CartItem($this->createManga(), 3);

        $this->assertSame($expectedSubtotal, $item->getSubtotal());
    }

}
