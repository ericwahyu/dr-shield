@section('title', 'Data Admin')
<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    @include('livewire.master-data.admin-data.admin-data-modal')
    <div class="d-flex align-items-center">
        <div>
            <h3 class="fw-semibold mb-0">Data Admin</h3>
        </div>
        {{-- <div class="ms-auto">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">Tambah <i class="fa-solid fa-circle-plus fa-fw ms-2"></i></button>
        </div> --}}
    </div>
    <hr class="my-3">
    <div class="card mb-3">
        <div class="card-body">
            <div class="row justify-content-between g-3">
                <div class="col-12 col-lg-5">
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
                        <th class="text-center">Nama</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" style="width: 10px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($admins as $result)
                        <tr>
                            <td class="text-center">{{ $admins->currentPage() * $perPage - $perPage + $loop->iteration }}</td>
                            <td class="text-center">{{ Str::title($result->name) }}</td>
                            <td class="text-center">{{ $result->email }}</td>
                            <td class="text-center">
                                @if ($result->status == 'active')
                                    <span class="badge rounded-pill bg-success bg-glow">Aktif</span>
                                @elseif ($result->status == 'non-active')
                                    <span class="badge rounded-pill bg-secondary bg-glow">Non Aktif</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button class="btn btn-danger btn-sm" wire:click="deleteConfirm('{{ $result->id }}')" x-data="{ tooltip: 'Hapus' }" x-tooltip="tooltip"><i class="fa-solid fa-trash-alt fa-fw"></i></button>
                                <button class="btn btn-warning btn-sm" wire:click="edit('{{ $result->id }}')" x-data="{ tooltip: 'Edit' }" x-tooltip="tooltip"><i class="fa-solid fa-pencil-alt fa-fw"></i></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="fw-bold text-center">Belum Ada Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-body">
            <div class="row d-flex align-items-center g-3">
                <div class="col-lg-6 col-12">Menampilkan {{ $admins->firstItem() }} sampai {{ $admins->lastItem() }} dari {{ $admins->total() }} hasil</div>
                <div class="d-flex justify-content-end col-lg-6 col-12">{{ $admins->links('vendor.livewire.simple-tailwind') }}</div>
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
            Livewire.on("closeModal", () => {
                jQuery('#modal').modal('hide');
            });
        });
    </script>
@endpush
