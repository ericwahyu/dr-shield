<div class="modal fade modal-md" id="modal-exit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Stock Keluar</h1>
                <button type="button" class="btn-close" wire:click="closeModal()"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-label">Nama Sample</div>
                        <input type="text" class="form-control" value="{{ $sample?->name }}" disabled>
                    </div>
                    <div class="col-6">
                        <div class="form-label">Profile</div>
                        <input type="text" class="form-control" value="{{ Str::title($sample?->profile) }}" disabled>
                    </div>
                    <div class="col-6">
                        <div class="form-label">Warna</div>
                        <input type="text" class="form-control" value="{{ Str::title($sample?->color) }}" disabled>
                    </div>
                    <div class="col-12">
                        <div class="form-label">Jumlah Stock Keluar <span class="text-danger">*</span></div>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" wire:model="stock" placeholder="Contoh : 2500">
                        @error('stock')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="col-12">
                        <div class="form-label">Keterangan </div>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="2" wire:model="description" placeholder="Contoh : Request Barang warna pink :)"></textarea>
                        @error('description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div> --}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" wire:click="closeModal()">Tutup <i class="fa-solid fa-circle-xmark fa-fw ms-2"></i></button>
                <button type="button" class="btn btn-success btn-sm" wire:click="saveDataExitSample()">Simpan <i class="fa-solid fa-circle-check fa-fw ms-2"></i></button>
            </div>
        </div>
    </div>
</div>
