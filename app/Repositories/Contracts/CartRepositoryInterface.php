<?php

namespace App\Repositories\Contracts;

interface CartRepositoryInterface
{
    public function getAllCartItems();
    public function addProductToCart($productId);
    public function updateCartItemQuantity($cartItemId, $quantity);
    public function removeCartItem($cartItemId);
    public function calculateSubtotal();
}