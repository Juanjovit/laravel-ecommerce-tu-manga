<?php

namespace Tests\Unit;

use App\Cart\Cart;
use App\Cart\CartItem;
use App\Models\Manga;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{

    public function createItem(int $id = 1, int $price = 105000, int $quantity = 1): CartItem
    {
        $manga = new Manga();
        $manga->id = $id;
        $manga->price = $price;
        return new CartItem($manga, $quantity);

    }

    public function test_can_add_a_cartitem_to_the_cart(): Cart
    {
        $id = 1;
        $item = $this->createItem();
        $cart = new \App\Cart\Cart;
        $cart->addItem($item);

        $this->assertCount(1, $cart->getItems());
        $this->assertSame($item, $cart->getItems()[0]);
        $this->assertSame($item, $cart->getItem($id));
        $this->assertSame(1, $cart->getItem($id)->getQuantity());

        return $cart;
    }

    #[Depends('test_can_add_a_cartitem_to_the_cart')]
    public function test_can_add_another_different_cartitem_to_the_cart(Cart $cart)
    {
        $id = 5;
        $item = $this->createItem($id);

        $cart->addItem($item);

        $this->assertCount(2, $cart->getItems());
        $this->assertSame($item, $cart->getItems()[1]);
        $this->assertSame($item, $cart->getItem($id));
        $this->assertSame(1, $cart->getItem($id)->getQuantity());

        return $cart;
    }

    #[Depends('test_can_add_another_different_cartitem_to_the_cart')]
    public function test_can_add_an_already_added_cartitem_to_the_cart_and_it_increase_its_quantity(Cart $cart)
    {
        $id = 1;
        $item = $this->createItem($id);

        $cart->addItem($item);

        $this->assertCount(2, $cart->getItems());
        $this->assertSame(2, $cart->getItem($id)->getQuantity());

        return $cart;
    }

    #[Depends('test_can_add_an_already_added_cartitem_to_the_cart_and_it_increase_its_quantity')]
    public function test_can_set_a_cartitem_quantity_to_a_custom_amount(Cart $cart)
    {
        $id = 5;
        $quantity = 3;

        $cart->setQuantity($id, $quantity);

        $this->assertSame($quantity, $cart->getItem($id)->getQuantity());

        return $cart;
    }

    #[Depends('test_can_set_a_cartitem_quantity_to_a_custom_amount')]
    public function test_can_increase_a_cartitem_quantity_by_a_default_of_1(Cart $cart)
    {
        $id = 5;

        $cart->increaseQuantity($id);

        $this->assertSame(4, $cart->getItem($id)->getQuantity());

        return $cart;
    }

    #[Depends('test_can_increase_a_cartitem_quantity_by_a_default_of_1')]
    public function test_can_increase_a_cartitem_quantity_by_a_custom_amount(Cart $cart)
    {
        $id = 5;

        $cart->increaseQuantity($id, 3);

        $this->assertSame(7, $cart->getItem($id)->getQuantity());

        return $cart;
    }

    #[Depends('test_can_increase_a_cartitem_quantity_by_a_custom_amount')]
    public function test_can_decrease_a_cartitem_quantity_by_a_default_of_1(Cart $cart)
    {
        $id = 5;

        $cart->decreaseQuantity($id);

        $this->assertSame(6, $cart->getItem($id)->getQuantity());

        return $cart;
    }

    #[Depends('test_can_decrease_a_cartitem_quantity_by_a_default_of_1')]
    public function test_can_decrease_a_cartitem_quantity_by_a_custom_amount(Cart $cart)
    {
        $id = 5;

        $cart->decreaseQuantity($id, 3);

        $this->assertSame(3, $cart->getItem($id)->getQuantity());

        return $cart;
    }

    #[Depends('test_can_decrease_a_cartitem_quantity_by_a_custom_amount')]
    public function test_can_remove_a_cartitem(Cart $cart)
    {
        $id = 1;

        $cart->removeItem($id);

        $this->assertCount(1, $cart->getItems());
        $this->assertSame(null, $cart->getItem($id));
        $this->assertSame(5, $cart->getItems()[0]->getId());
    }

    public function test_can_get_the_total_price_of_the_cart()
    {
        $expectedTotal = (105000 * 2) + 100000 + 120000;
        $cart = new Cart();
        $cart->addItem($this->createItem(1, 105000, 2));
        $cart->addItem($this->createItem(5, 100000, 1));
        $cart->addItem($this->createItem(9, 120000, 1));

        $this->assertSame($expectedTotal, $cart->getTotal());
    }
}
