<?php

namespace App\Http\Controllers\Discount;

use App\Http\Controllers\Controller;
use App\Services\DiscountService;   
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    protected $discountService;

    public function __construct(DiscountService $discountService)
    {
        $this->discountService = $discountService;
    }

    public function apply(Request $request)
    {
        $request->validate(['discount_code' => 'required']);
        $code = $request->input('discount_code');
        $discountResult = $this->discountService->applyDiscount($code);

        if (!$discountResult) {
            return redirect()->route('cart.index')->withErrors('Invalid discount code');
        }

        $cartItems = $this->discountService->getCartItems();
        $subtotal = $this->discountService->getSubtotal();
        $discountAmount = $discountResult['discountAmount'];
        $total = $discountResult['total'];

        return view('pages.cart.cart', compact('cartItems', 'subtotal', 'discountAmount', 'total'));
    }
}
