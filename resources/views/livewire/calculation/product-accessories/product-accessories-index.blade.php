@section('title', 'Perhitungan Produk Aksesoris')
<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="d-flex align-items-center">
        <div>
            <h3 class="fw-semibold mb-0">Produk Aksesoris</h3>
        </div>
        {{-- <div class="ms-auto">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">Tambah <i class="fa-solid fa-circle-plus fa-fw ms-2"></i></button>
        </div> --}}
    </div>
    <hr class="my-3">
    <div class="row">
        <div class="col-md-7">
            <div class="card mb-4">
                <h5 class="card-header">Form Ukuran</h5>
                <div class="card-body">
                    <label class="form-label">List Produk <strong>Aksesoris</strong> <span class="text-danger">*</span></label>
                    <div class="row">
                        @error('product')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        @foreach ($products as $product)
                            <div class="col-md-4">
                                <div class="form-check mt-2">
                                    <input name="default-radio-1" class="form-check-input" type="radio" wire:model.live="product" value="{{ $product->id }}" id="defaultRadio{{ $loop->iteration }}">
                                    <label class="form-check-label" for="defaultRadio{{ $loop->iteration }}">{{ Str::upper($product->name) }}</label>
                                    <span class="text-secondary">{{ Str::title($product->profile) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{-- <label class="form-label"><strong>Aksesoris</strong></label> --}}
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card mb-4">
                <h5 class="card-header">Perhitungan</h5>
                <div class="card-body">
                    <div class="row">
                        @if ($get_product?->calculated == 'accessories')
                            {{-- <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="length" class="form-label">Ukuran Panjang <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('length') is-invalid @enderror" id="length" wire:model="length">
                                    <div id="defaultFormControlHelp" class="form-text">Masukkan Satuan M (meter)</div>
                                    @error('length')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="width" class="form-label">Ukuran Lebar <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('width') is-invalid @enderror" id="width" wire:model="width">
                                    <div id="defaultFormControlHelp" class="form-text">Masukkan Satuan M (meter)</div>
                                    @error('width')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @elseif ($get_product?->calculated == 'pieces')
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="pieces" class="form-label">jumlah Item <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('pieces') is-invalid @enderror" id="pieces" wire:model="pieces">
                                    <div id="defaultFormControlHelp" class="form-text">Masukkan Satuan Pack</div>
                                    @error('pieces')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endif
                        @if ($get_product)
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label for="width" class="form-label">&ensp;&ensp;&ensp;</label>
                                    <button type="button" class="btn btn-success btn-sm p-3"wire:click="productCalculator()">Hitung</button>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if ($width && $get_product?->calculated == 'accessories')
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Hasil Perhitungan</span></label>
                                <div class="list-group list-group-flush">
                                    <span class="list-group-item">@if ($width && $get_product) ({{ $width }} x 1000) : {{ $width_product }}@endif</span>
                                    <span class="list-group-item">@if ($width && $get_product) {{ $width_mm }} : {{ $width_product }}@endif</span>
                                    {{-- <span class="list-group-item">@if ($width && $get_product) {{ $count_item_roundup }} Lembar @endif</span> --}}
                                    <span class="list-group-item">@if ($width && $get_product) {{ $count_item_roundup }} Lembar x Rp. {{ number_format($get_product?->price, 0, ',', '.') }} (per {{ $get_product?->price_unit }})  @endif</span>
                                    <span class="list-group-item">@if ($width && $get_product) <b>Rp. {{ number_format($grand_total, 0, ',', '.') }}</b> @endif</span>
                                </div>
                            </div>
                        </div>
                    @elseif ($pieces && $get_product?->calculated == 'pieces')
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label">Hasil Perhitungan</span></label>
                                <div class="list-group list-group-flush">
                                    {{-- <span class="list-group-item">@if ($length && $width && $get_product) ({{ $width }} x 1000) : {{ $width_product }}@endif</span> --}}
                                    {{-- <span class="list-group-item">@if ($length && $width && $get_product) {{ $width_mm }} : {{ $width_product }}@endif</span> --}}
                                    {{-- <span class="list-group-item">@if ($length && $width && $get_product) {{ $count_item_roundup }} Lembar @endif</span> --}}
                                    <span class="list-group-item">@if ($pieces && $get_product) {{ $pieces }} x Rp. {{ number_format($get_product?->price, 0, ',', '.') }} (per {{ $get_product?->price_unit }})  @endif</span>
                                    <span class="list-group-item">@if ($pieces && $get_product) <b>Rp. {{ number_format($grand_total, 0, ',', '.') }}</b> @endif</span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
