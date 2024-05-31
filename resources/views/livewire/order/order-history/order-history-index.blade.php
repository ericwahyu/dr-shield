@section('title', 'Riwayat Pesanan')
<div>
    {{-- The best athlete wants his opponent at his best. --}}
    @include('livewire.order.order-history.order-history-detail')
    <div class="d-flex align-items-center">
        <div>
            <h3 class="fw-semibold mb-0">Riwayat Pesanan</h3>
        </div>
        {{-- <div class="ms-auto">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">Tambah <i class="fa-solid fa-circle-plus fa-fw ms-2"></i></button>
        </div> --}}
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
                        <th class="text-center">Nama</th>
                        <th class="text-center">No. Handphone</th>
                        <th class="text-center">Alamat</th>
                        <th class="text-center">kebutuhan</th>
                        <th class="text-center">Kode Pesanan</th>
                        <th class="text-center">Total Harga</th>
                        <th class="text-center" style="width: 10px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $result)
                        <tr>
                            <td class="text-center">{{ $result?->order_date?->isoFormat('D MMMM Y') }}</td>
                            <td class="text-center">{{ $orders->currentPage() * $perPage - $perPage + $loop->iteration }}</td>
                            <td class="text-center">
                                @if ($result?->category == 'store')
                                    <b>Toko</b>
                                @elseif ($result?->category == 'project')
                                    <b>Proyek</b>
                                @elseif ($result?->category == 'e-commerce')
                                    <b>E-Commerce</b>
                                @endif
                            </td>
                            <td class="text-center">{{ $result?->customer->name }}</td>
                            <td class="text-center">{{ $result?->customer->phone }}</td>
                            <td class="text-center">{{ $result?->customer->address }}</td>
                            <td class="text-center">{{ $result?->customer->needs }}</td>
                            {{-- <td class="text-center">{{ $result?->customer->description }}</td> --}}
                            <td class="text-center">{{ $result?->order_code }}</td>
                            {{-- <td class="text-center"><b>{{ $result?->orderDetails->sum('total_price') }}</b></td> --}}
                            <td class="text-center"><b>Rp. {{ number_format($result?->orderDetails?->sum('total_price'), 0, ',', '.') }}</b></td>
                            <td class="text-center">
                                <button class="btn btn-danger btn-sm" wire:click="deleteConfirm('{{ $result->id }}')" x-data="{ tooltip: 'Hapus' }" x-tooltip="tooltip"><i class="fa-solid fa-trash-alt fa-fw"></i></button>
                                <button class="btn btn-info btn-sm" wire:click="detail('{{ $result->id }}')" x-data="{ tooltip: 'Detail' }" x-tooltip="tooltip"><i class="fa-solid fa-circle-info fa-fw"></i></button>
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
                <div class="col-lg-6 col-12">Menampilkan {{ $orders->firstItem() }} sampai {{ $orders->lastItem() }} dari {{ $orders->total() }} hasil</div>
                <div class="d-flex justify-content-end col-lg-6 col-12">{{ $orders->links('vendor.livewire.simple-tailwind') }}</div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            Livewire.on("openModal", () => {
                jQuery('#modal-detail').modal('show');
            });
            Livewire.on("closeModal", () => {
                jQuery('#modal-detail').modal('hide');
            });
        });
    </script>
@endpush
