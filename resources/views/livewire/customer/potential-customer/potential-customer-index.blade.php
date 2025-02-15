@section('title', 'Data Calon Pelanggan')
<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    @include('livewire.customer.potential-customer.potential-customer-modal')
    <div class="d-flex align-items-center">
        <div>
            <h3 class="fw-semibold mb-0">Calon Pelanggan</h3>
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
                        <th class="text-center">Tanggal</th>
                        <th class="text-center" style="width: 10px;">No</th>
                        <th class="text-center">Kategori</th>
                        <th class="text-center">No. HP</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Kebutuhan</th>
                        <th class="text-center">Alamat</th>
                        <th class="text-center">Toko</th>
                        <th class="text-center">Keterangan</th>
                        <th class="text-center">Response</th>
                        <th class="text-center" style="width: 10px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $result)
                        <tr>
                            <td class="text-center">{{ $result?->date->isoFormat('D MMMM Y') }}</td>
                            <td class="text-center">{{ $customers?->currentPage() * $perPage - $perPage + $loop->iteration }}</td>
                            <td class="text-center">
                                @if ($result?->category == 'store')
                                    <b>Toko</b>
                                @elseif ($result?->category == 'project')
                                    <b>Proyek</b>
                                @endif
                            </td>
                            <td class="text-center">{{ $result?->phone }}</td>
                            <td class="text-center">{{ $result?->name }}</td>
                            <td class="text-center">{{ $result?->needs }}</td>
                            <td class="text-center">{{ $result?->address }}</td>
                            <td class="text-center">{{ $result?->store }}</td>
                            <td class="text-center">{{ $result?->description }}</td>
                            <td class="text-center">
                                @if ($result?->response == 'no-response')
                                    <span class="badge rounded-pill bg-dark bg-glow">Tidak Respon</span>
                                @elseif ($result?->response == 'going-store-looking-stock')
                                    <span class="badge rounded-pill bg-warning bg-glow">Menuju Toko / Lihat Barang</span>
                                @elseif ($result?->response == 'store')
                                    <span class="badge rounded-pill bg-info bg-glow">Toko</span>
                                @elseif ($result?->response == 'stock-empty-awaiting-stock')
                                    <span class="badge rounded-pill bg-warning bg-glow">Barang Kosong, Masih Menunggu</span>
                                @elseif ($result?->response == 'only-question')
                                    <span class="badge rounded-pill bg-warning bg-glow">Hanya Bertanya</span>
                                @elseif ($result?->response == 'used-other-product')
                                    <span class="badge rounded-pill bg-facebook bg-glow">Menggunakan Produk Lain</span>
                                @elseif ($result?->response == 'not-yet-development')
                                    <span class="badge rounded-pill bg-warning bg-glow">Belum Pembangunan</span>
                                @elseif ($result?->response == 'negotiation')
                                    <span class="badge rounded-pill bg-secondary bg-glow">Negosiasi</span>
                                @elseif ($result?->response == 'done')
                                    <span class="badge rounded-pill bg-success bg-glow">Selesai</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button class="btn btn-danger btn-sm" wire:click="deleteConfirm('{{ $result?->id }}')" x-data="{ tooltip: 'Hapus' }" x-tooltip="tooltip"><i class="fa-solid fa-trash-alt fa-fw"></i></button>
                                <button class="btn btn-warning btn-sm" wire:click="edit('{{ $result?->id }}')" x-data="{ tooltip: 'Edit' }" x-tooltip="tooltip"><i class="fa-solid fa-pencil-alt fa-fw"></i></button>
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
                <div class="col-lg-6 col-12">Menampilkan {{ $customers?->firstItem() }} sampai {{ $customers?->lastItem() }} dari {{ $customers?->total() }} hasil</div>
                <div class="d-flex justify-content-end col-lg-6 col-12">{{ $customers?->links('vendor.livewire.simple-tailwind') }}</div>
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
