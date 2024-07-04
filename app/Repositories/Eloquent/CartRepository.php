<?php

namespace App\Repositories\Eloquent;

use App\Models\CartItems;
use App\Models\Products;
use App\Repositories\Contracts\CartRepositoryInterface;

class CartRepository implements CartRepositoryInterface
{
    public function getAllCartItems()
    {
        return CartItems::with('product')->get();
    }

    public function addProductToCart($productId)
    {
        $cartItem = CartItems::firstOrCreate(
            ['product_id' => $productId],
            ['quantity' => 1]
        );

        if (!$cartItem->wasRecentlyCreated) {
            $cartItem->increment('quantity');
        }

        return $cartItem;
    }

    public function updateCartItemQuantity($cartItemId, $quantity)
    {
        $cartItem = CartItems::find($cartItemId);
        if ($cartItem) {
            $cartItem->update(['quantity' => $quantity]);
            return $cartItem;
        }
        return null;
    }

    public function removeCartItem($cartItemId)
    {
        $cartItem = CartItems::find($cartItemId);
        if ($cartItem) {
            $cartItem->delete();
            return true;
        }
        return false;
    }

    public function calculateSubtotal()
    {
        $cartItems = $this->getAllCartItems();
        return $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    }
}
