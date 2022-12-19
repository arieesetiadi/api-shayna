<table class="table table-sm table-bordered">
    <tr>
        <td>Nama</td>
        <td>{{ $transaction->name }}</td>
    </tr>
    <tr>
        <td>Email</td>
        <td>{{ $transaction->email }}</td>
    </tr>
    <tr>
        <td>Nomor</td>
        <td>{{ $transaction->number }}</td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>{{ $transaction->address }}</td>
    </tr>
    <tr>
        <td>Total Transaksi (Rp.)</td>
        <td>{{ number_format($transaction->transaction_total) }}</td>
    </tr>
    <tr>
        <td>Status Transaksi</td>
        <td>{{ $transaction->transaction_status }}</td>
    </tr>

    {{-- Detail --}}
    <tr>
        <td>Pembelian Produk</td>
        <td>
            <table class="table table-sm table-hover">
                <tr>
                    <th>Nama</th>
                    <th>Tipe</th>
                    <th>Harga (Rp.)</th>
                </tr>
                @foreach ($transaction->detail as $detail)
                    <tr>
                        <td>{{ $detail->product->name }}</td>
                        <td>{{ $detail->product->type }}</td>
                        <td>{{ number_format($detail->product->price) }}</td>
                    </tr>
                @endforeach
            </table>
        </td>
    </tr>
</table>

<div class="row">
    <div class="col-4 d-flex justify-content-center">
        <a href="{{ route('transactions.status', $transaction->id) }}?status=SUCCESS"
           class="btn btn-success">
            <i class="fa fa-check"></i> Set Sukses
        </a>
    </div>
    <div class="col-4 d-flex justify-content-center">
        <a href="{{ route('transactions.status', $transaction->id) }}?status=FAILED"
           class="btn btn-danger">
            <i class="fa fa-times"></i> Set Gagal
        </a>
    </div>
    <div class="col-4 d-flex justify-content-center">
        <a href="{{ route('transactions.status', $transaction->id) }}?status=PENDING"
           class="btn btn-warning">
            <i class="fa fa-spinner"></i> Set Pending
        </a>
    </div>
</div>
