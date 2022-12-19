@extends('layouts.default')

@section('content')

    {{-- Main Content --}}
    <div class="container">
        {{-- Alert container --}}
        @if (session('message'))
            <div class="alert alert-{{ session('message')['status'] }}"
                 role="alert">
                {{ session('message')['body'] }}
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                @if (count($transactions) > 0)
                    <div class="card">
                        <div class="card-header bg-white">
                            <h5>Daftar Transaksi</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Nomor HP</th>
                                        <th>Total Transaksi (Rp.)</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
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
                                            <td>
                                                @if ($transaction->transaction_status == 'PENDING')
                                                    <a href="{{ route('transactions.status', $transaction->id) }}?status=SUCCESS"
                                                       class="btn btn-sm btn-success">
                                                        <i class="fa fa-check"></i>
                                                    </a>
                                                    <a href="{{ route('transactions.status', $transaction->id) }}?status=FAILED"
                                                       class="btn btn-sm btn-danger">
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                @endif

                                                {{-- Tombol detail --}}
                                                <a href="#transactionDetailModal{{ $transaction->id }}"
                                                   data-toggle="modal"
                                                   data-target="#transactionDetailModal{{ $transaction->id }}"
                                                   class="btn btn-sm btn-info">
                                                    <i class="fa fa-eye"></i>
                                                </a>

                                                {{-- Tombol edit --}}
                                                <a href="{{ route('transactions.edit', $transaction->id) }}"
                                                   class="btn btn-sm btn-light">
                                                    <i class="fa fa-pencil"></i>
                                                </a>

                                                {{-- Tombol hapus --}}
                                                <div class="inline-block">
                                                    <form id="deleteTransactionForm"
                                                          action="{{ route('transactions.destroy', $transaction->id) }}"
                                                          method="POST"
                                                          class="d-inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <button class="btn btn-sm btn-danger d-inline-block"
                                                            onclick="swalFormConfirmation('deleteTransactionForm')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>

                                                {{-- Transaction Detail Modal --}}
                                                <div class="modal fade"
                                                     id="transactionDetailModal{{ $transaction->id }}"
                                                     tabindex="-1"
                                                     role="dialog"
                                                     aria-labelledby="transactionDetailModalLabel"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog modal-lg"
                                                         role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="transactionDetailModalLabel">
                                                                    Detail Transaksi
                                                                    <strong>{{ $transaction->uuid }}</strong>
                                                                </h5>
                                                                <button type="button"
                                                                        class="close"
                                                                        data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @include('pages.transactions.show')
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <h5 class="text-center">Data transaksi tidak tersedia.</h5>
                @endif
            </div>
        </div>
    </div>
@endsection
