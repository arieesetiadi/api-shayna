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
                        <h5>Tambah Barang</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('products.store') }}"
                              method="POST">
                            @csrf
                            {{-- Input nama barang --}}
                            <div class="form-group mb-3">
                                <label for="name">Nama Barang :</label>
                                <input name="name"
                                       id="name"
                                       type="text"
                                       value="{{ old('name') }}"
                                       placeholder="Masukan nama barang"
                                       class="form-control @error('name')
                                            border-danger
                                        @enderror">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Input tipe barang --}}
                            <div class="form-group mb-3">
                                <label for="type">Tipe Barang :</label>
                                <input name="type"
                                       id="type"
                                       type="text"
                                       value="{{ old('type') }}"
                                       placeholder="Masukan tipe barang"
                                       class="form-control @error('type')
                                            border-danger
                                        @enderror">
                                @error('type')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Input deskripsi barang --}}
                            <div class="form-group mb-3">
                                <label for="description">Deskripsi Barang :</label>
                                <textarea name="description"
                                          id="description"
                                          placeholder="Masukan deskripsi barang"
                                          class="ckeditor form-control @error('description')
                                            border-danger
                                        @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Input harga barang --}}
                            <div class="form-group mb-3">
                                <label for="price">Harga Barang (Rp.) :</label>
                                <input name="price"
                                       id="price"
                                       type="number"
                                       value="{{ old('price') }}"
                                       placeholder="Masukan harga barang"
                                       class="form-control @error('price')
                                            border-danger
                                        @enderror">
                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Input jumlah barang --}}
                            <div class="form-group mb-3">
                                <label for="quantity">Jumlah Barang (Rp.) :</label>
                                <input name="quantity"
                                       id="quantity"
                                       type="number"
                                       value="{{ old('quantity') }}"
                                       placeholder="Masukan jumlah barang"
                                       class="form-control @error('quantity')
                                            border-danger
                                        @enderror">
                                @error('quantity')
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
