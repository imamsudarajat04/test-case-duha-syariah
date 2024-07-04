@extends('layouts.app')

@section('content')
    <h2 class="text-center">Featured Products</h2>
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-3">
                <div class="card mb-4">
                    <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            {{-- @csrf --}}
                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
