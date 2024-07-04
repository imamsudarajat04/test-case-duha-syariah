<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\CartRepositoryInterface;

class CartController extends Controller
{
    protected $cartRepository;

    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function index()
    {
        $cartItems = $this->cartRepository->getAllCartItems();
        $subtotal = $this->cartRepository->calculateSubtotal();
        $discountAmount = 0; // Nilai default untuk discountAmount
        $total = $subtotal; // Nilai default untuk total

        return view('pages.cart.cart', compact('cartItems', 'subtotal', 'discountAmount', 'total'));
    }

    public function add(Request $request, $productId)
    {
        $this->cartRepository->addProductToCart($productId);
        return redirect()->route('cart.index');
    }

    public function update(Request $request, $cartItemId)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);
        $this->cartRepository->updateCartItemQuantity($cartItemId, $request->quantity);
        return redirect()->route('cart.index');
    }

    public function destroy($cartItemId)
    {
        $this->cartRepository->removeCartItem($cartItemId);
        return redirect()->route('cart.index');
    }
}
