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
                @if (count($products) > 0)
                    <div class="card">
                        <div class="card-header bg-white">
                            <h5>Daftar Produk</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm data-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Tipe</th>
                                        <th>Harga (Rp.)</th>
                                        <th>Stok (Pcs)</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $i => $product)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->type }}</td>
                                            <td>{{ number_format($product->price) }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>
                                                {{-- Tombol galleries --}}
                                                <a href="#"
                                                   class="btn btn-sm btn-info {{ count($product->galleries) == 0 ? 'disabled' : '' }}"
                                                   data-toggle="modal"
                                                   data-target="#productGalleriesModal{{ $product->id }}">
                                                    <i class="fa fa-image"></i>
                                                </a>

                                                {{-- Tombol edit --}}
                                                <a href="{{ route('products.edit', $product->id) }}"
                                                   class="btn btn-sm btn-light">
                                                    <i class="fa fa-pencil"></i>
                                                </a>

                                                {{-- Tombol hapus --}}
                                                <form id="deleteProductForm"
                                                      action="{{ route('products.destroy', $product->id) }}"
                                                      method="POST"
                                                      class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button class="btn btn-sm btn-danger"
                                                        onclick="swalFormConfirmation('deleteProductForm')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        {{-- Pop-up galleries --}}
                                        <div class="modal fade"
                                             id="productGalleriesModal{{ $product->id }}"
                                             tabindex="-1"
                                             role="dialog"
                                             aria-labelledby="productGalleriesModal{{ $product->id }}Title"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered"
                                                 role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title"
                                                            id="exampleModalLongTitle">Foto dari
                                                            <strong>{{ $product->name }}</strong>
                                                        </h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{-- Carousel --}}
                                                        <div id="productGalleriesCarousel{{ $product->id }}"
                                                             class="carousel slide"
                                                             data-ride="carousel">
                                                            <ol class="carousel-indicators">
                                                                {{-- Bottom indicator --}}
                                                                @foreach ($product->galleries as $i => $gallery)
                                                                    <li data-target="#productGalleriesCarousel{{ $product->id }}"
                                                                        data-slide-to="{{ $i }}"
                                                                        class="{{ $i == 0 ? 'active' : '' }}"></li>
                                                                @endforeach
                                                            </ol>
                                                            <div class="carousel-inner">
                                                                {{-- Loop images --}}
                                                                @foreach ($product->galleries as $i => $gallery)
                                                                    <div
                                                                         class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                                                                        <img class="d-block w-100"
                                                                             src="{{ asset($gallery->photo) }}"
                                                                             alt="{{ $i + 1 }} Slide">
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <a class="carousel-control-prev"
                                                               href="#productGalleriesCarousel{{ $product->id }}"
                                                               role="button"
                                                               data-slide="prev">
                                                                <span class="carousel-control-prev-icon"
                                                                      aria-hidden="true"></span>
                                                                <span class="sr-only">Previous</span>
                                                            </a>
                                                            <a class="carousel-control-next"
                                                               href="#productGalleriesCarousel{{ $product->id }}"
                                                               role="button"
                                                               data-slide="next">
                                                                <span class="carousel-control-next-icon"
                                                                      aria-hidden="true"></span>
                                                                <span class="sr-only">Next</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button"
                                                                class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <h5 class="text-center">Data produk tidak tersedia.</h5>
                @endif
            </div>
        </div>
    </div>
@endsection
