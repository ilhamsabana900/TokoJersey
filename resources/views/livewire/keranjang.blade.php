<div class="container">
    <div class="row mb-2">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }} " class="text-dark">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><strong>Keranjang</strong></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if(session()->has('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>Gambar</td>
                            <td>Keterangan</td>
                            <td>Nama Set</td>
                            <td>Harga Nameset</td>
                            <td>Jumlah</td>
                            <td>Harga</td>
                            <td><strong>Total Harga</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no =1 ?>
                        {{-- kenapa menggunakan forelse karena ada tempat untuk data kosong --}}
                        @forelse ($pesanan_details as $pesanan_detail)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>
                                <img src="{{ url('assets/jersey') }}/{{ $pesanan_detail->product->gambar }}" class="img-fluid" width="150">
                            </td>
                            <td>
                                {{ $pesanan_detail->product->nama }}
                            </td>
                            <td>
                                @if($pesanan_detail->nameset)
                                    Nama : {{ $pesanan_detail->nama }} <br>
                                    Nomor : {{ $pesanan_detail->nomor }}
                                @else
                                 -
                                @endif
                                
                            </td>
                            <td>
                                @if($pesanan_detail->nameset)
                                    Rp. {{ number_format($pesanan_detail->product->harga_nameset) }}
                                @else
                                 -
                                @endif
                                
                            </td>
                            <td>
                                {{ $pesanan_detail->jumlah_pesanan }}
                            </td>
                            <td>
                                Rp. {{ number_format($pesanan_detail->product->harga) }}
                            </td>
                            <td>
                                <strong>Rp. {{ number_format($pesanan_detail->total_harga) }}</strong>
                            </td>
                            <td>
                                <i wire:click="destroy({{ $pesanan_detail->id }})" class="fas fa-trash text-danger"></i>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="9">kosong</td>
                            </tr>
                        @endforelse
                        
                        @if(!empty($pesanan))
                        <tr>
                            <td colspan="9" align ="right"><strong>Total harga = Rp. {{ number_format($pesanan->total_harga) }}</strong></td>
                            
                        </tr>
                        <tr>
                            <td colspan="9" align ="right"><strong>Kode Unik = Rp. {{ number_format($pesanan->kode_unik) }}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="9" align ="right"><strong>total_harga = Rp. {{ number_format($pesanan->total_harga + $pesanan->kode_unik) }}</strong></td>
                        </tr>
                        <tr>
                            <td colspan="8"></td>
                            <td colspan="2">
                                <a href="{{ route('checkout') }}" class="btn btn-success btn-block">
                                    <i class="fas fa-arrow-right"></i> CheckOut
                                </a>
                            </td>
                        @endif
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
