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
                        <h5>Tambah Gambar Barang</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('product-galleries.store') }}"
                              method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            {{-- Input pilihan barang --}}
                            <div class="form-group mb-3">
                                <label for="productId">Pilih Barang :</label>
                                <select name="product_id"
                                        id="productId"
                                        class="form-control @error('product_id')
                                            border-danger
                                        @enderror">
                                    <option value=""
                                            selected
                                            hidden>Pilih barang</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Input gambar barang --}}
                            <div class="form-group mb-3">
                                <label for="photo">Gambar Barang :</label>
                                <input name="photo"
                                       id="photo"
                                       type="file"
                                       accept="image/*"
                                       class="form-control @error('photo')
                                            border-danger
                                        @enderror">
                                @error('photo')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Input isDefault gambar --}}
                            <div class="form-group mb-3">
                                <label for="type"
                                       class="d-block">Jadikan Default :</label>
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input"
                                           type="radio"
                                           name="is_default"
                                           id="ya"
                                           value="1"
                                           checked>
                                    <label class="form-check-label"
                                           for="ya">
                                        Ya
                                    </label>
                                </div>
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input"
                                           type="radio"
                                           name="is_default"
                                           id="tidak"
                                           value="0">
                                    <label class="form-check-label"
                                           for="tidak">
                                        Tidak
                                    </label>
                                </div>
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
