<?php

namespace App\Services;

use App\Models\Discounts;
use App\Repositories\Contracts\CartRepositoryInterface;
use Carbon\Carbon;

class DiscountService
{
    protected $cartRepository;

    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function applyDiscount($code)
    {
        $discount = Discounts::where('code', $code)->first();

        if (!$discount) {
            return null;
        }

        $cartItems = $this->cartRepository->getAllCartItems();
        $subtotal = $this->cartRepository->calculateSubtotal();

        $discountAmount = 0;

        switch ($discount->type) {
            case 'percentage':
                $discountAmount = $subtotal * ($discount->value / 100);
                break;

            case 'fixed':
                $discountAmount = $discount->value;
                break;

            case 'product_specific':
                foreach ($cartItems as $item) {
                    if ($item->product->code == $discount->product_code) {
                        $discountAmount = $discount->value;
                    }
                }
                break;

            case 'time_specific':
                $now = Carbon::now();
                if ($now->isTuesday() && $now->between($now->copy()->setTime(13, 0), $now->copy()->setTime(15, 0))) {
                    $discountAmount = $subtotal * ($discount->value / 100);
                }
                break;

            case 'price_specific':
                foreach ($cartItems as $item) {
                    if ($item->product->price > 400000) {
                        $discountAmount += $item->product->price * ($discount->value / 100);
                    }
                }
                break;

            default:
                break;
        }

        $total = $subtotal - $discountAmount;

        return [
            'discountAmount' => $discountAmount,
            'total' => $total
        ];
    }

    public function getCartItems()
    {
        return $this->cartRepository->getAllCartItems();
    }

    public function getSubtotal()
    {
        return $this->cartRepository->calculateSubtotal();
    }
}

