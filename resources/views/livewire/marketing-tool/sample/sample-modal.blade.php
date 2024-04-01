<div class="modal fade modal-md" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Form Data Sample</h1>
                <button type="button" class="btn-close" wire:click="closeModal()"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-label">Nama Sample <span class="text-danger">*</span></div>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name" placeholder="Contoh : Eric Wahyu Amiruddin">
                        @error('name')
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
                    <div class="col-6">
                        <div class="form-label">Warna <span class="text-danger">*</span></div>
                        <input type="text" class="form-control @error('color') is-invalid @enderror" wire:model="color" placeholder="Contoh : Merah">
                        @error('color')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    @if (!$sample)
                        <div class="col-12">
                            <div class="form-label">Stock <span class="text-danger">*</span></div>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" wire:model="stock" placeholder="Contoh : 2500">
                            @error('stock')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" wire:click="closeModal()">Tutup <i class="fa-solid fa-circle-xmark fa-fw ms-2"></i></button>
                <button type="button" class="btn btn-success btn-sm" wire:click="saveData()">Simpan <i class="fa-solid fa-circle-check fa-fw ms-2"></i></button>
            </div>
        </div>
    </div>
</div>
