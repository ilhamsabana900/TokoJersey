<div class="container">
    <div class="row mb-2">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }} " class="text-dark">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('keranjang') }} " class="text-dark">keranjang</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><strong>Checkout</strong></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if (session()->has('message'))
                <div class="alert alert-danger">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col">
            <a href="{{ route('keranjang') }}" class="btn btn-sm btn-dark"><i class="fas fa-arrow-left"></i>Kembali</a>

        </div>


        <div class="row mt-4">
            <div class="col">
                <h4>Informasi Pembayaran</h4>
                <hr>
                <p>Silahkan melakukan pembayaran sebesar : <strong>{{ number_format($total_harga) }}</strong></p>
                <div class="media">
                    <img class="mr-3" src="{{ url('assets/bri.png') }}" alt="Bank BRI" width="30">
                    <div class="media-body">
                        <h5 class="mt-0">BANK BRI</h5>
                        Silahkan melakukan pembayaran ke No. Rek 123-456-789 atas nama <strong>Muhammad Ilham</strong>
                    </div>
                </div>
            </div>
            <div class="col">
                <h4>Status Pengiriman</h4>
                <hr>
                <form wire:submit.prevent="checkout">
                    <div class="form-group">
                        <label for="">No. HP</label>
                        <input id="nohp" type="text" class="form-control @error('nohp') is-invalid @enderror"
                            wire:model="nohp" autocomplete="current-password">

                        @error('nohp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea wire:model="alamat" class="form-control @error('nameset') is-invalid @enderror" wire:model="nama"></textarea>
                        @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success btn-block mt-2"><i class="fas fa-arrow-right"></i>Checkout</button>
                </form>
            </div>
        </div>
    </div>
</div>
