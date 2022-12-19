@extends('layouts.default')

@section('content')
    {{-- Alert container --}}
    @if (session('message'))
        <div class="alert alert-{{ session('message')['status'] }}"
             role="alert">
            {{ session('message')['body'] }}
        </div>
    @endif

    <!-- Animated -->
    <div class="animated fadeIn">
        <!-- Widgets  -->
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-1">
                                <i class="pe-7s-cash"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text">Rp. <span class="count">{{ number_format($income) }}</span>
                                    </div>
                                    <div class="stat-heading">Penghasilan</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-2">
                                <i class="pe-7s-cart"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count">{{ $sales }}</span></div>
                                    <div class="stat-heading">Penjualan</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Widgets -->
        <!--  /Traffic -->
        <div class="clearfix"></div>
        <!-- Orders -->
        <div class="orders">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="box-title">Pembelian Terbaru </h4>
                        </div>
                        <div class="card-body--">
                            <div class="table-stats order-table ov-h">
                                <table class="table ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Nomor HP</th>
                                            <th>Total Transaksi (Rp.)</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $i => $transaction)
                                            <tr>
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ $transaction->name }}</td>
                                                <td>{{ $transaction->email }}</td>
                                                <td>{{ $transaction->number }}</td>
                                                <td>{{ number_format($transaction->transaction_total) }}</td>
                                                <td>
                                                    @if ($transaction->transaction_status == 'PENDING')
                                                        <span class="badge badge-warning">
                                                            {{ $transaction->transaction_status }}
                                                        </span>
                                                    @elseif($transaction->transaction_status == 'SUCCESS')
                                                        <span class="badge badge-success">
                                                            {{ $transaction->transaction_status }}
                                                        </span>
                                                    @elseif($transaction->transaction_status == 'FAILED')
                                                        <span class="badge badge-danger">
                                                            {{ $transaction->transaction_status }}
                                                        </span>
                                                    @else
                                                        <span>
                                                            {{ $transaction->transaction_status }}
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- /.table-stats -->
                        </div>
                    </div> <!-- /.card -->
                </div> <!-- /.col-lg-8 -->
            </div>
        </div>
        <!-- /.orders -->
        <!-- /#add-category -->
    </div>
    <!-- .animated -->
@endsection
