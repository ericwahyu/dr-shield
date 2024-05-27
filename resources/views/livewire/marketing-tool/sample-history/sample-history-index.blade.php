@section('title', 'Data Riwayat Sample')
<div>
    {{-- Be like water. --}}
    <div class="d-flex align-items-center">
        <div>
            <h3 class="fw-semibold mb-0">Data Riwayat Sample</h3>
        </div>
        {{-- <div class="ms-auto">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">Tambah <i class="fa-solid fa-circle-plus fa-fw ms-2"></i></button>
        </div> --}}
    </div>
    <hr class="my-3">
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card mb-3">
                {{-- <h5 class="card-header">Filter Tanggal</h5> --}}
                <div class="card-body">
                    <div class="row gx-3 gy-2 align-items-center">
                        <div class="col-md-2">
                            <label class="form-label" for="selectType">Tanggal Mulai</label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" wire:model.live="filter_start_date">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" for="selectAnimation">Tanggal Terakhir</label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror" wire:model.live="filter_end_date">
                        </div>
                        <div class="col-md-2">
                            @if ($filter_start_date || $filter_end_date)
                                <label class="form-label" for="selectAnimation">&nbsp;</label>
                                <button id="showToastAnimation" class="btn btn-danger d-block waves-effect waves-light p-3" wire:click="clearFilter()">Clear Filter</button>
                            @endif
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" for="selectAnimation">Tipe Rekap</label>
                            <select class="form-select" id="status" wire:model.live="filter_recap" aria-label="Default select example">
                                <option value=""selected style="display: none">-- Pilih Rekap--</option>
                                <option value="entry">Barang Masuk</option>
                                <option value="exit">Barang Keluar</option>
                                <option value="">Hapus filter...</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                        <th class="text-center">Nama Sample</th>
                        <th class="text-center">Profile Sample</th>
                        <th class="text-center">Warna Sample</th>
                        <th class="text-center">Jumlah Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sample_histories as $result)
                        <tr>
                            <td class="text-center">{{ $result->created_at->isoFormat('dddd, D MMMM Y') }}</td>
                            <td class="text-center">{{ $sample_histories->currentPage() * $perPage - $perPage + $loop->iteration }}</td>
                            <td class="text-start">{{ $result?->sample?->name }}</td>
                            <td class="text-center">{{ Str::title($result?->sample?->profile) }}</td>
                            <td class="text-center">{{ Str::title($result?->sample?->color) }}</td>
                            @if ($result->type == 'entry')
                                <td class="text-center text-success fs-5"><b>{{ number_format($result?->value, 0, ',', '.') }}</b></td>
                            @elseif ($result->type == 'exit')
                                <td class="text-center text-danger fs-5"><b>{{ number_format($result?->value, 0, ',', '.') }}</b></td>
                            @endif
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
                <div class="col-lg-6 col-12">Menampilkan {{ $sample_histories->firstItem() }} sampai {{ $sample_histories->lastItem() }} dari {{ $sample_histories->total() }} hasil</div>
                <div class="d-flex justify-content-end col-lg-6 col-12">{{ $sample_histories->links('vendor.livewire.simple-tailwind') }}</div>
            </div>
        </div>
    </div>
</div>
