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
                @if (count($productGalleries) > 0)
                    <div class="card">
                        <div class="card-header bg-white">
                            <h5>Daftar Foto Produk</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Barang</th>
                                        <th>Foto</th>
                                        <th>Default</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productGalleries as $i => $productGallery)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $productGallery->product->name }}</td>
                                            <td>
                                                <img width="100px"
                                                     src="{{ url($productGallery->photo) }}"
                                                     alt="Product Gallery"
                                                     class="rounded">
                                            </td>
                                            <td>{{ $productGallery->is_default ? 'Iya' : 'Tidak' }}</td>
                                            <td>
                                                {{-- Tombol edit --}}
                                                <a href="{{ route('product-galleries.edit', $productGallery->id) }}"
                                                   class="btn btn-sm btn-light">
                                                    <i class="fa fa-pencil"></i>
                                                </a>

                                                {{-- Tombol hapus --}}
                                                <form id="deleteProductGalleryForm"
                                                      action="{{ route('product-galleries.destroy', $productGallery->id) }}"
                                                      method="POST"
                                                      class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button class="btn btn-sm btn-danger"
                                                        onclick="swalFormConfirmation('deleteProductGalleryForm')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <h5 class="text-center">Data foto tidak tersedia.</h5>
                @endif
            </div>
        </div>
    </div>
@endsection
