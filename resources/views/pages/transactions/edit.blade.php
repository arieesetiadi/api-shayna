@extends('layouts.default')

@section('content')
    {{-- Alert container --}}
    @if (session('message'))
        <div class="alert alert-{{ session('message')['status'] }}"
             role="alert">
            {{ session('message')['body'] }}
        </div>
    @endif

    {{-- Main Content --}}
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5>Ubah Transaksi <strong>{{ $transaction->uuid }}</strong></h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('transactions.update', $transaction->id) }}"
                              method="POST">
                            @csrf
                            @method('PUT')
                            {{-- Input nama barang --}}
                            <div class="form-group mb-3">
                                <label for="name">Nama Pemesan :</label>
                                <input name="name"
                                       id="name"
                                       type="text"
                                       value="{{ old('name', $transaction->name) }}"
                                       placeholder="Masukan nama barang"
                                       class="form-control @error('name')
                                            border-danger
                                        @enderror">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Input email pemesan --}}
                            <div class="form-group mb-3">
                                <label for="email">Email Pemesan :</label>
                                <input name="email"
                                       id="email"
                                       type="email"
                                       value="{{ old('email', $transaction->email) }}"
                                       placeholder="Masukan email pemesan"
                                       class="form-control @error('email')
                                            border-danger
                                        @enderror">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Input nomor pemesan --}}
                            <div class="form-group mb-3">
                                <label for="number">Nomor Pemesan :</label>
                                <input name="number"
                                       id="number"
                                       type="text"
                                       value="{{ old('number', $transaction->number) }}"
                                       placeholder="Masukan nomor pemesan"
                                       class="form-control @error('number')
                                            border-danger
                                        @enderror">
                                @error('number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Input alamat pemesan --}}
                            <div class="form-group mb-3">
                                <label for="address">Alamat Pemesan :</label>
                                <input name="address"
                                       id="address"
                                       type="text"
                                       value="{{ old('address', $transaction->address) }}"
                                       placeholder="Masukan nomor pemesan"
                                       class="form-control @error('address')
                                            border-danger
                                        @enderror">
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Tombol submit --}}
                            <button type="submit"
                                    class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
