@section('title', 'Data Pelanggan Proyek')
<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    @include('livewire.customer.customer-project.customer-project-modal')
    <div class="d-flex align-items-center">
        <div>
            <h3 class="fw-semibold mb-0">Pelanggan Proyek</h3>
        </div>
        <div class="ms-auto">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">Tambah <i class="fa-solid fa-circle-plus fa-fw ms-2"></i></button>
        </div>
    </div>
    <hr class="my-3">
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="card mb-3">
                {{-- <h5 class="card-header">Filter Tanggal</h5> --}}
                <div class="card-body">
                    <div class="row gx-3 gy-2 align-items-center">
                        <div class="col-md-4">
                            {{-- <label class="form-label" for="selectType">Tanggal Mulai</label> --}}
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" wire:model.live="start_date">
                        </div>
                        <div class="col-md-1">
                            <label class="form-label" for="selectType">&nbsp;</label>
                            <label class="form-label" for="selectType">To</label>
                            {{-- <input type="date" class="form-control @error('start_date') is-invalid @enderror" wire:model.live="start_date"> --}}
                        </div>
                        <div class="col-md-4">
                            {{-- <label class="form-label" for="selectAnimation">Tanggal Terakhir</label> --}}
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror" wire:model.live="end_date">
                        </div>
                        @if ($start_date || $end_date)
                            <div class="col-md-3">
                                <button id="showToastAnimation" class="btn btn-danger d-block waves-effect waves-light p-3" wire:click="clearFilter()">Clear Filter</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                        <th class="text-center">Tanggal</th>
                        <th class="text-center" style="width: 10px;">No</th>
                        <th class="text-center">Kategori</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">No. HP</th>
                        <th class="text-center">Kebutuhan</th>
                        <th class="text-center">Alamat</th>
                        {{-- <th class="text-center">Toko</th> --}}
                        <th class="text-center">Keterangan</th>
                        <th class="text-center">Response</th>
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
                                @if ($result?->customer?->category == 'store')
                                    <b>Toko</b>
                                @elseif ($result?->customer?->category == 'project')
                                    <b>Proyek</b>
                                @endif
                            </td>
                            <td class="text-center">{{ $result?->customer->name }}</td>
                            <td class="text-center">0{{ $result?->customer->phone }}</td>
                            <td class="text-center">{{ $result?->customer->needs }}</td>
                            <td class="text-center">{{ $result?->customer->address }}</td>
                            <td class="text-center">{{ $result?->customer->description }}</td>
                            <td class="text-center">
                                @if ($result?->customer?->response == 'no-response')
                                    <span class="badge rounded-pill bg-dark bg-glow">Tidak Respon</span>
                                @elseif ($result?->customer?->response == 'going-store-looking-stock')
                                    <span class="badge rounded-pill bg-warning bg-glow">Menuju Toko / Lihat Barang</span>
                                @elseif ($result?->customer?->response == 'store')
                                    <span class="badge rounded-pill bg-info bg-glow">Toko</span>
                                @elseif ($result?->customer?->response == 'stock-empty-awaiting-stock')
                                    <span class="badge rounded-pill bg-warning bg-glow">Barang Kosong, Masih Menunggu</span>
                                @elseif ($result?->customer?->response == 'only-question')
                                    <span class="badge rounded-pill bg-warning bg-glow">Hanya Bertanya</span>
                                @elseif ($result?->customer?->response == 'used-other-product')
                                    <span class="badge rounded-pill bg-facebook bg-glow">Menggunakan Produk Lain</span>
                                @elseif ($result?->customer?->response == 'not-yet-development')
                                    <span class="badge rounded-pill bg-warning bg-glow">Belum Pembangunan</span>
                                @elseif ($result?->customer?->response == 'negotiation')
                                    <span class="badge rounded-pill bg-secondary bg-glow">Negosiasi</span>
                                @elseif ($result?->customer?->response == 'done')
                                    <span class="badge rounded-pill bg-success bg-glow">Selesai</span>
                                @endif
                            </td>
                            {{-- <td class="text-center"><b>{{ $result?->orderDetails->sum('total_price') }}</b></td> --}}
                            <td class="text-center"><b>Rp. {{ number_format($result?->orderDetails?->sum('total_price'), 0, ',', '.') }}</b></td>
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
                {{-- <div class="col-lg-6 col-12">Menampilkan {{ $customers->firstItem() }} sampai {{ $customers->lastItem() }} dari {{ $customers->total() }} hasil</div>
                <div class="d-flex justify-content-end col-lg-6 col-12">{{ $customers->links('vendor.livewire.simple-tailwind') }}</div> --}}
            </div>
        </div>
    </div>
    @if ($grand_total)
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="card mb-4">
                    <h5 class="card-header">Total Harga</h5>
                    <div class="card-body">
                        <div class="d-flex text-align-center">
                            <div class="ms-auto">
                                <h1>Rp. {{ number_format($grand_total, 0, ',', '.') }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
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

