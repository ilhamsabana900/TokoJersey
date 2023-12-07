<div class="container">
    <div class="row mb-2">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }} " class="text-dark">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <h2>{{ $title }}</h2>
        </div>
        <div class="col-md-3">
            <div class="input-group mb-3">
                <div class="form-floating">
                    <input wire:model="search" type="text" class="form-control" id="floatingInputGroup1" placeholder="Search">
                    <label for="floatingInputGroup1">Search...</label>
                </div>
                <span class="input-group-text">
                    <i class="fas fa-search"></i>
                </span>
              </div>
        </div>
    </div>
    <section class="product mb-5">
        <div class="row mt-4">
            @foreach ($products as $product)
                <div class="col-md-3 mb-3">
                    <div class="card shadow">
                        <div class="card-body text-center">
                            <img src="{{ url('assets/jersey') }}/{{ $product->gambar }}" class="img-fluid">
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <h5><strong>{{ $product->nama }}</strong></h5>
                                    <h5>Rp. {{ number_format($product->harga) }}</h5>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <a href="{{ route('products.detail', $product->id) }}" class="btn btn-dark btn-block"><i class="fas fa-eye"></i>
                                        Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            @endforeach

            
        </div>
        <div class="row">
            <div class="col">
                <div class="d-felx justify-content-center">
                    {{ $products->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </section>
</div>
