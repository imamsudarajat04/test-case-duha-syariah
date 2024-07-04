@extends('layouts.app')

@section('content')
    <h2 class="text-center">Troli Anda</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>PRODUK</th>
                <th>PILIHAN HARGA</th>
                <th>KUANTITAS</th>
                <th>SUBTOTAL</th>
                <th>HAPUS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $item)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="img-thumbnail" style="width: 50px; height: 50px;">
                            <div class="ml-3">
                                <h5 class="mb-0">{{ $item->product->name }}</h5>
                                <small>{{ $item->product->code }}</small>
                            </div>
                        </div>
                    </td>
                    <td>Rp. {{ number_format($item->product->price, 0, ',', '.') }}</td>
                    <td>
                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control" style="width: 70px;">
                            <button type="submit" class="btn btn-link p-0"><i class="fas fa-sync-alt"></i></button>
                        </form>
                    </td>
                    <td>Rp. {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                    <td>
                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link text-danger p-0"><i class="fas fa-times"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" class="text-right">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#discountModal">
                        Gunakan Kode Diskon/Reward
                    </button>
                </td>
                <td>
                    <h5>DISKON: Rp. {{ number_format($discountAmount ?? 0, 0, ',', '.') }}</h5>
                </td>
                <td class="text-right">
                    <h5>TOTAL: Rp. {{ number_format($total ?? $subtotal, 0, ',', '.') }}</h5>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="discountModal" tabindex="-1" aria-labelledby="discountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="discountModalLabel">Kode Diskon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('discount.apply') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="discount_code">Discount code</label>
                            <input type="text" class="form-control" id="discount_code" name="discount_code">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Terapkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
