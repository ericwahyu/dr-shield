<div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Form Akun Admin</h1>
                <button type="button" class="btn-close" wire:click="closeModal()"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-label">Nama Lengkap <span class="text-danger">*</span></div>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name">
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="form-label">Email <span class="text-danger">*</span></div>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model="email">
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="form-label">Status <span class="text-danger">*</span></div>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" wire:model="status" aria-label="Default select example">
                            <option value=""selected style="display: none">-- Pilih Respon --</option>
                            <option value="active" {{ $status == 'active' ? "selected" : "" }}>Aktif</option>
                            <option value="non-active" {{ $status == 'non-active' ? "selected" : "" }}>Non Aktif</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- @if (!$data_id)
                        <div class="col-12">
                            <div class="form-label">Password <span class="text-danger">*</span></div>
                            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" aria-describedby="password2" wire:model="password">
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif --}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" wire:click="closeModal()">Tutup <i class="fa-solid fa-circle-xmark fa-fw ms-2"></i></button>
                <button type="button" class="btn btn-success btn-sm" wire:click="saveData()">Simpan <i class="fa-solid fa-circle-check fa-fw ms-2"></i></button>
            </div>
        </div>
    </div>
</div>
