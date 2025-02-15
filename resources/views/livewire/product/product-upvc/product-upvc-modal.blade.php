<div class="modal fade modal-md" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Form Data UPVC</h1>
                <button type="button" class="btn-close" wire:click="closeModal()"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-label">Kategori <span class="text-danger">*</span></div>
                        {{-- <input type="text" class="form-control @error('category') is-invalid @enderror" wire:model="category" placeholder=""> --}}
                        <select class="form-select @error('category') is-invalid @enderror" id="category" wire:model="category" aria-label="Default select example">
                            <option value=""selected style="display: none">-- Pilih Kategori --</option>
                            <option value="RF Premium Series" {{ $category == 'RF Premium Series' ? "selected" : "" }}>RF Premium Series</option>
                            <option value="OD Series" {{ $category == 'OD Series' ? "selected" : "" }}>OD Series</option>
                            <option value="Aksesoris" {{ $category == 'Aksesoris' ? "selected" : "" }}>Aksesoris</option>
                        </select>
                        @error('category')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="form-label">Nama <span class="text-danger">*</span></div>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name" placeholder="Contoh : Single Wall">
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <div class="form-label">Ukuran Lebar Efektif <span class="text-danger">*</span></div>
                        <input type="number" class="form-control @error('effective_width') is-invalid @enderror" wire:model="effective_width" placeholder="Contoh : 2610">
                        <div id="defaultFormControlHelp" class="form-text">Masukkan Satuan mm (milimeter)</div>
                        @error('effective_width')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <div class="form-label">Profile <span class="text-danger">*</span></div>
                        <select class="form-select @error('profile') is-invalid @enderror" id="profile" wire:model="profile" aria-label="Default select example">
                            <option value=""selected style="display: none">-- Pilih Profile --</option>
                            <option value="doff" {{ $profile == 'doff' ? "selected" : "" }}>Doff</option>
                            <option value="translucent" {{ $profile == 'translucent' ? "selected" : "" }}>Translucent</option>
                        </select>
                        @error('profile')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="form-label">Harga <span class="text-danger">*</span></div>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" wire:model="price" placeholder="Contoh : 990000">
                        @error('price')
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
