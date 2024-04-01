<div class="modal fade modal-md" id="modal-note-payment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Nota Pembayaran</h1>
                <button type="button" class="btn-close" wire:click="closeModal()"></button>
            </div>
            <div class="modal-body p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('assets/image/logo-drshield.png') }}" alt="..." style="max-height: 50px">
                    </div>
                    <div class="flex-grow-1 ms-3 text-center">
                        <p class="mb-1"><b>ESTIMASI HARGA</b></p>
                        <p class="mb-1"><b>PT RAGAM TANGGUH FORTINDO</b></p>
                    </div>
                </div>
                <hr class="my-2">
                <div class="d-flex">
                    <div>
                        <label class="h6 p-3 mb-0"><b>Produk : </b> <strong>{{ $get_product?->name }}</strong></label>
                    </div>
                    <div class="ms-auto">
                        <span class="badge rounded-pill bg-dark bg-glow mb-0">Genteng</span>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <span class="m-3 h6"><b>Panjang : </b> <strong>{{ $length }}</strong> M</span>
                    </div>
                    <div class="col-md-6">
                        <span class="m-3 h6"><b>Lebar : </b> <strong>{{ $width }}</strong> M</span>
                    </div>
                </div>
                <hr class="my-2">
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
                <span class="text-secondary">nb. kebutuhan diatas hanya estimasi berdasarkan ukuran yang telah diinformasikan oleh customer.</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" wire:click="closeModal()">Tutup <i class="fa-solid fa-circle-xmark fa-fw ms-2"></i></button>
                <button type="button" class="btn btn-success btn-sm" wire:click="saveData()">Simpan <i class="fa-solid fa-circle-check fa-fw ms-2"></i></button>
            </div>
        </div>
    </div>
</div>
