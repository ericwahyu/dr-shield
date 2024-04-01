<div class="modal fade modal-md" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Form Pelanggan Masuk</h1>
                <button type="button" class="btn-close" wire:click="closeModal()"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="form-label">Nama <span class="text-danger">*</span></div>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name" placeholder="Contoh : Eric Wahyu Amiruddin" disabled>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <div class="form-label">Nomor Handphone <span class="text-danger">*</span></div>
                        <input type="number" class="form-control @error('phone') is-invalid @enderror" wire:model="phone" placeholder="Contoh : 08XXXXXXXXXX" disabled>
                        @error('phone')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <div class="form-label">Kebutuhan <span class="text-danger">*</span></div>
                        <textarea class="form-control @error('needs') is-invalid @enderror" id="needs" rows="2" wire:model="needs" placeholder="Contoh : Perlangakapan Bahan Pembangunan" disabled></textarea>
                        @error('needs')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <div class="form-label">Alamat <span class="text-danger">*</span></div>
                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" rows="2" wire:model="address" placeholder="Contoh : Jl. Raya Tapi Sempit" disabled></textarea>
                        @error('address')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="form-label">Toko <span class="text-danger">*</span></div>
                        <input type="text" class="form-control @error('store') is-invalid @enderror" wire:model="store" placeholder="Contoh : Toko Tanah Abang" disabled>
                        @error('store')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="form-label">Keterangan </div>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="2" wire:model="description" placeholder="Contoh : Jl. Raya Tapi Sempit"disabled></textarea>
                        @error('description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="form-label">Total Harga <span class="text-danger">*</span></div>
                        <input type="number" class="form-control @error('total_price') is-invalid @enderror" wire:model="total_price" placeholder="Contoh : 10000000">
                        @error('total_price')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" wire:click="closeModal()">Tutup <i class="fa-solid fa-circle-xmark fa-fw ms-2"></i></button>
                <button type="button" class="btn btn-success btn-sm" wire:click="saveData()">Simpan <i class="fa-solid fa-circle-check fa-fw ms-2"></i></button>
            </div>
        </div>
    </div>
</div>
