@section('title', 'Pesanan Genteng')
<div>
    {{-- In work, do what you enjoy. --}}
    @include('livewire.order.order-roof.order-roof-note-modal')
    <div class="d-flex align-items-center">
        <div>
            <h3 class="fw-semibold mb-0">Produk Genteng</h3>
        </div>
        {{-- <div class="ms-auto">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">Tambah <i class="fa-solid fa-circle-plus fa-fw ms-2"></i></button>
        </div> --}}
    </div>
    <hr class="my-3">
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <h5 class="card-header">Form Ukuran</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label for="length" class="form-label">Ukuran Panjang <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('length') is-invalid @enderror" id="length" wire:model="length">
                                <div id="defaultFormControlHelp" class="form-text">Masukkan Satuan M (meter)</div>
                                @error('length')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
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
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="width" class="form-label">&ensp;</label>
                                <button type="button" class="btn btn-success btn-sm p-3"wire:click="roofCalculator()">Hitung</button>
                            </div>
                        </div>
                    </div>
                    <label class="form-label">List Produk <span class="text-danger">*</span></label>
                    <div class="row">
                        @error('product')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        @forelse ($products as $product)
                            <div class="col-md-4">
                                <div class="form-check mt-2">
                                    <input name="default-radio-1" class="form-check-input" type="radio" wire:model="product" value="{{ $product->id }}" id="defaultRadio{{ $loop->iteration }}">
                                    <label class="form-check-label" for="defaultRadio{{ $loop->iteration }}">{{ Str::upper($product->name) }}</label>
                                    <span class="text-secondary">{{ Str::title($product->profile) }}</span>
                                </div>
                            </div>
                        @empty

                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <h5 class="card-header">Hasil Perhitungan</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="list-group list-group-flush">
                                <span class="list-group-item">@if ($length && $width && $get_product) ({{ $length_mm }} : {{ $length_product }}) x ({{ $width_mm }} : {{ $width_product }}) @endif</span>
                                <span class="list-group-item">@if ($length && $width && $get_product) {{ $length_value_1 }} x {{ $width_value_1 }} @endif</span>
                                <span class="list-group-item">@if ($length && $width && $get_product) {{ $length_roundup }} x {{ $width_roundup }} @endif</span>
                                <span class="list-group-item">@if ($length && $width && $get_product) {{ $count_item }} Lembar @endif</span>
                                <span class="list-group-item"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="list-group list-group-flush">
                                <span class="list-group-item">@if ($length && $width && $get_product) {{ $count_item }} x Rp. {{ number_format($get_product?->price, 0, ',', '.') }} (per Lembar) @endif</span>
                                <span class="list-group-item">@if ($length && $width && $get_product) <b>Rp. {{ number_format($grand_total, 0, ',', '.') }}</b> @endif</span>
                                <span class="list-group-item"></span>
                            </div>
                        </div>
                    </div>
                    @if ($grand_total)
                    <div class="d-flex flex-row-reverse">
                        <button type="button" class="btn btn-success btn-sm p-3" data-bs-toggle="modal" data-bs-target="#modal-note-payment"">Cetak</button>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            Livewire.on("openModal", () => {
                jQuery('#modal-note-payment').modal('show');
            });
            Livewire.on("closeModal", () => {
                jQuery('#modal-note-payment').modal('hide');
            });
        });
    </script>
@endpush
