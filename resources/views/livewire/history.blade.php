<div class="container">
    <div class="row mb-2">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }} " class="text-dark">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><strong>History</strong></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </div>

    <div class="row mt-4">
        <div class="col">
            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>Tanggal Pesanan</td>
                            <td>Kode Pesanan</td>
                            <td>Pesanan</td>
                            <td>Status</td>
                            <td><strong>Total Harga</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        {{-- kenapa menggunakan forelse karena ada tempat untuk data kosong --}}
                        @forelse ($pesanans as $pesanan)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $pesanan->created_at }}</td>
                                <td>{{ $pesanan->kode_pesanan }}</td>
                                <td>
                                    <?php $pesanan_details = App\Models\PesananDetail::where('pesanan_id', $pesanan->id)->get(); ?>
                                    @foreach ($pesanan_details as $pesanan_detail)
                                        <img src="{{ url('assets/jersey') }}/{{ $pesanan_detail->product->gambar }}"
                                            class="img-fluid" width="50">
                                        {{ $pesanan_detail->product->nama }}
                                    @endforeach
                                </td>
                                <td>
                                    @if ($pesanan->status == 1)
                                        Sudah Lunas
                                    @else
                                        belum lunas
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ number_format($pesanan->total_harga) }}</strong>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-body">
                    <p>Silahkan melakukan pembayaran :</strong></p>
                    <div class="media">
                        <img class="mr-3" src="{{ url('assets/bri.png') }}" alt="Bank BRI" width="30">
                        <div class="media-body">
                            <h5 class="mt-0">BANK BRI</h5>
                            Silahkan melakukan pembayaran ke No. Rek 123-456-789 atas nama <strong>Muhammad
                                Ilham</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
