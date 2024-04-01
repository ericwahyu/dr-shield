@section('title', 'Stock Sample')
<div>
    {{-- The best athlete wants his opponent at his best. --}}
    @include('livewire.marketing-tool.sample.sample-modal')
    @include('livewire.marketing-tool.sample.entry-sample-modal')
    @include('livewire.marketing-tool.sample.exit-sample-modal')
    <div class="d-flex align-items-center">
        <div>
            <h3 class="fw-semibold mb-0">Stock Sample</h3>
        </div>
        <div class="ms-auto">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">Tambah <i class="fa-solid fa-circle-plus fa-fw ms-2"></i></button>
        </div>
    </div>
    <hr class="my-3">
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-between g-3">
                <div class="col-12 col-lg-4">
                    <div class="row">
                        <div class="col-lg-6 col-12 d-flex align-items-center gap-2">
                            <div>Lihat</div>
                            <select class="form-select" wire:model.live="perPage">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <div class="ms-auto">Hasil</div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-12 col-lg-4">
                    <div class="row">
                        <div class="col-lg-10 col-12 d-flex align-items-center gap-2">
                            <input class="form-control" type="date" wire:model.live="filter_date" id="html5-date-input">
                        </div>
                    </div>
                </div> --}}
                <div class="col-12 col-lg-4 text-end">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa-regular fa-magnifying-glass fa-fw"></i></span>
                        <input class="form-control" type="text" placeholder="Cari Sesuatu.." wire:model.live="search">
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive scrollbar-x">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 10px;">No</th>
                        <th class="text-center">Name Sample</th>
                        <th class="text-center">Profile</th>
                        <th class="text-center">Warna</th>
                        <th class="text-center">Stock</th>
                        <th class="text-center" style="width: 10px;">Menu</th>
                        <th class="text-center" style="width: 10px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($samples as $result)
                        <tr>
                            <td class="text-center">{{ $samples->currentPage() * $perPage - $perPage + $loop->iteration }}</td>
                            <td class="text-start">{{ $result->name }}</td>
                            <td class="text-center">{{ Str::title($result->profile) }}</td>
                            <td class="text-center">{{ Str::title($result->color) }}</td>
                            <td class="text-center">{{ number_format($result->stock, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <button class="btn btn-success btn-sm" wire:click="entryStock('{{ $result->id }}')" x-data="{ tooltip: 'Stock Masuk' }" x-tooltip="tooltip"><i class="fa-solid fa-down fa-fw"></i></button>
                                <button class="btn btn-danger btn-sm" wire:click="exitStock('{{ $result->id }}')" x-data="{ tooltip: 'Stock Keluar' }" x-tooltip="tooltip"><i class="fa-solid fa-up fa-fw"></i></button>
                                {{-- <button class="btn btn-warning btn-sm" wire:click="edit('{{ $result->id }}')" x-data="{ tooltip: 'Edit' }" x-tooltip="tooltip"><i class="fa-solid fa-pencil-alt fa-fw"></i></button>
                                <button class="btn btn-danger btn-sm" wire:click="deleteConfirm('{{ $result->id }}')" x-data="{ tooltip: 'Hapus' }" x-tooltip="tooltip"><i class="fa-solid fa-trash-alt fa-fw"></i></button> --}}
                            </td>
                            <td class="text-center">
                                {{-- <button class="btn btn-success btn-sm" wire:click="entryStock('{{ $result->id }}')" x-data="{ tooltip: 'Stock Masuk' }" x-tooltip="tooltip"><i class="fa-solid fa-down fa-fw"></i></button>
                                <button class="btn btn-danger btn-sm" wire:click="exitStock('{{ $result->id }}')" x-data="{ tooltip: 'Stock Keluar' }" x-tooltip="tooltip"><i class="fa-solid fa-up fa-fw"></i></button> --}}
                                <button class="btn btn-warning btn-sm" wire:click="edit('{{ $result->id }}')" x-data="{ tooltip: 'Edit' }" x-tooltip="tooltip"><i class="fa-solid fa-pencil-alt fa-fw"></i></button>
                                <button class="btn btn-danger btn-sm" wire:click="deleteConfirm('{{ $result->id }}')" x-data="{ tooltip: 'Hapus' }" x-tooltip="tooltip"><i class="fa-solid fa-trash-alt fa-fw"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="fw-bold text-center">Belum Ada Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-body">
            <div class="row d-flex align-items-center g-3">
                <div class="col-lg-6 col-12">Menampilkan {{ $samples->firstItem() }} sampai {{ $samples->lastItem() }} dari {{ $samples->total() }} hasil</div>
                <div class="d-flex justify-content-end col-lg-6 col-12">{{ $samples->links('vendor.livewire.simple-tailwind') }}</div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            Livewire.on("openModal", () => {
                jQuery('#modal').modal('show');
            });
            Livewire.on("openModalEntry", () => {
                jQuery('#modal-entry').modal('show');
            });
            Livewire.on("openModalExit", () => {
                jQuery('#modal-exit').modal('show');
            });
            Livewire.on("closeModal", () => {
                jQuery('#modal').modal('hide');
                jQuery('#modal-entry').modal('hide');
                jQuery('#modal-exit').modal('hide');
            });
        });
    </script>
@endpush
