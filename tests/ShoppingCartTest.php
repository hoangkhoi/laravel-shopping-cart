<?php

namespace Melihovv\ShoppingCart\Tests;

use Orchestra\Testbench\TestCase;

require_once __DIR__ . '/../vendor/phpunit/phpunit/src/Framework/Assert/Functions.php';

class ShoppingCartTest extends TestCase
{
    use ShoppingCartTester;

    public function testAddItemToCart()
    {
        $this->addItemToCart();

        assertEquals(1, \Cart::count());

        $this->addItemToCart(2);

        assertEquals(2, \Cart::count());
    }

    public function testRemoveItemFromCart()
    {
        $items = $this->addItemsToCart();

        \Cart::remove($items[2]->getUniqueId());

        assertEquals(4, \Cart::count());
    }

    public function testUpdateQuantity()
    {
        $cartItem = $this->addItemToCart(1, '', 100, 5);
        \Cart::setQuantity($cartItem->getUniqueId(), 10);

        assertEquals(10, \Cart::get($cartItem->getUniqueId())->quantity);
    }

    public function testClearCart()
    {
        $this->addItemsToCart();

        \Cart::clear();

        assertEquals(0, \Cart::count());
    }
}