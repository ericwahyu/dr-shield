<div class="modal fade modal-md" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Form Daftar Pelanggan</h1>
                <button type="button" class="btn-close" wire:click="closeModal()"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="form-label">Tanggal <span class="text-danger">*</span></div>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" wire:model="date">
                        @error('date')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <div class="form-label">Kategori Pelanggan <span class="text-danger">*</span></div>
                        <select class="form-select @error('category') is-invalid @enderror" id="status" wire:model.live="category" aria-label="Default select example">
                            <option value=""selected style="display: none">-- Pilih Kategori --</option>
                            <option value="store" {{ $category == 'store' ? "selected" : "" }}>Toko</option>
                            <option value="project" {{ $category == 'project' ? "selected" : "" }}>Proyek</option>
                            {{-- <option value="e-commerce" {{ $category == 'e-commerce' ? "selected" : "" }}>E-Commerce</option> --}}
                        </select>
                        @error('category')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <div class="form-label">Nama <span class="text-danger">*</span></div>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name" placeholder="Contoh : Eric Wahyu Amiruddin">
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <div class="form-label">Nomor Handphone <span class="text-danger">*</span></div>
                        <input type="number" class="form-control @error('phone') is-invalid @enderror" wire:model="phone" placeholder="Contoh : 08XXXXXXXXXX">
                        @error('phone')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <div class="form-label">Kebutuhan </div>
                        <textarea class="form-control @error('needs') is-invalid @enderror" id="needs" rows="2" wire:model="needs" placeholder="Contoh : Perlangakapan Bahan Pembangunan"></textarea>
                        @error('needs')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <div class="form-label">Alamat </div>
                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" rows="2" wire:model="address" placeholder="Contoh : Jl. Raya Tapi Sempit"></textarea>
                        @error('address')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="form-label">Toko </div>
                        <input type="text" class="form-control @error('store') is-invalid @enderror" wire:model="store" placeholder="Contoh : Toko Tanah Abang">
                        @error('store')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="form-label">Keterangan </div>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="2" wire:model="description" placeholder="Contoh : Request Barang warna pink :)"></textarea>
                        @error('description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="form-label">Respon <span class="text-danger">*</span></div>
                        <select class="form-select @error('response') is-invalid @enderror" id="status" wire:model="response" aria-label="Default select example">
                            @if ($category && $category == 'store')
                                <option value=""selected style="display: none">-- Pilih Respon --</option>
                                <option value="no-response" {{ $response == 'no-response' ? "selected" : "" }}>Tidak Respon</option>
                                <option value="going-store-looking-stock" {{ $response == 'going-store-looking-stock' ? "selected" : "" }}>Menuju Toko / Lihat Barang</option>
                                <option value="store" {{ $response == 'store' ? "selected" : "" }}>Toko</option>
                                <option value="stock-empty-awaiting-stock" {{ $response == 'stock-empty-awaiting-stock' ? "selected" : "" }}>Barang Kosong, Masih Menunggu</option>
                                <option value="only-question" {{ $response == 'only-question' ? "selected" : "" }}>Hanya Bertanya</option>
                                <option value="used-other-product" {{ $response == 'used-other-product' ? "selected" : "" }}>Menggunakan Produk Lain</option>
                                <option value="not-yet-development" {{ $response == 'not-yet-development' ? "selected" : "" }}>Belum Pembangunan</option>
                                <option value="done" {{ $response == 'done' ? "selected" : "" }}>Selesai</option>
                            @elseif ($category && $category == 'project')
                                <option value=""selected style="display: none">-- Pilih Respon --</option>
                                <option value="negotiation" {{ $response == 'negotiation' ? "selected" : "" }}>Negosiasi</option>
                                <option value="done" {{ $response == 'done' ? "selected" : "" }}>Selesai</option>
                            @endif
                        </select>
                        @error('response')
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
