@section('title', 'Data Persentase Pelanggan')
@section('styles')
    <style>
        .custom-option.checked {
            border: 1px solid #CF0000;
        }

        .custom-option.checked {
            border: 1px solid #CF0000;
        }

        .form-check {
            padding-left: 0;
            margin-bottom: 0;
            min-height: 0;
        }
    </style>
@endsection
<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="d-flex align-items-center">
        <div>
            <h3 class="fw-semibold mb-0">Persentase Pelanggan</h3>
        </div>
        {{-- <div class="ms-auto">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">Tambah <i class="fa-solid fa-circle-plus fa-fw ms-2"></i></button>
        </div> --}}
    </div>
    <hr class="my-3">
    <div class="row mb-3">
        <div class="col-xl-12">
            <div class="card">
                <h6 class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="">
                            <span class="h5">Percentase</span>
                        </div>
                    </div>
                </h6>
                <div class="card-body">
                    <div class="row gx-3 gy-2 align-items-center mb-3 col-xl-5">
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
                    <div class="row">
                        <div class="col-md-2 mb-md-0 mb-2">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="customRadioTemp1">
                                    <input name="customRadioTemp" class="form-check-input" type="radio" wire:model.live="category_percentage" value="all" id="customRadioTemp1" {{ $category_percentage == 'all' ? "checked" : "" }}>
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Pelanggan</span>
                                        <span class="text-muted">{{ $this->percentageCustomer()[0] }}%</span>
                                    </span>
                                    <span class="custom-option-body">
                                        <small>{{ $this->percentageCustomer()[1] }} pelanggan</small>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-md-0 mb-2">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="customRadioTemp2">
                                    <input name="customRadioTemp" class="form-check-input" type="radio" wire:model.live="category_percentage" value="potential_customer" id="customRadioTemp2" {{ $category_percentage == 'potential_customer' ? "checked" : "" }}>
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Calon Pelanggan</span>
                                        <span class="text-muted">{{ $this->potentialCustomer()[0] }}%</span>
                                    </span>
                                    <span class="custom-option-body">
                                        <small>{{ $this->potentialCustomer()[1] }} Pelanggan</small>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-md-0 mb-2">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="customRadioTemp3">
                                    <input name="customRadioTemp" class="form-check-input" type="radio" wire:model.live="category_percentage" value="store_sale_done" id="customRadioTemp3" {{ $category_percentage == 'store_sale_done' ? "checked" : "" }}>
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Penjualan Toko (Done)</span>
                                        <span class="text-muted">{{ $this->storeSaleDoneCustomer()[0] }}%</span>
                                    </span>
                                    <span class="custom-option-body">
                                        <small>{{ $this->storeSaleDoneCustomer()[1] }} Pelanggan</small>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-md-0 mb-2">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="customRadioTemp4">
                                    <input name="customRadioTemp" class="form-check-input" type="radio" wire:model.live="category_percentage" value="other-product" id="customRadioTemp4" {{ $category_percentage == 'other-product' ? "checked" : "" }}>
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Produk Lain</span>
                                        <span class="text-muted">{{ $this->percentageOtherProduct()[0] }}%</span>
                                    </span>
                                    <span class="custom-option-body">
                                        <small>{{ $this->percentageOtherProduct()[1] }} Pelanggan</small>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-md-0 mb-2">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="customRadioTemp5">
                                    <input name="customRadioTemp" class="form-check-input" type="radio" wire:model.live="category_percentage" value="store" id="customRadioTemp5" {{ $category_percentage == 'store' ? "checked" : "" }}>
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Toko</span>
                                        <span class="text-muted">{{ $this->percentageStore()[0] }}%</span>
                                    </span>
                                    <span class="custom-option-body">
                                        <small>{{ $this->percentageStore()[1] }} Pelanggan</small>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-md-0 mb-2">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="customRadioTemp6">
                                    <input name="customRadioTemp" class="form-check-input" type="radio" wire:model.live="category_percentage" value="no-response" id="customRadioTemp6" {{ $category_percentage == 'no-response' ? "checked" : "" }}>
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Tidak Respon</span>
                                        <span class="text-muted">{{ $this->percentageNoResponse()[0] }}%</span>
                                    </span>
                                    <span class="custom-option-body">
                                        <small>{{ $this->percentageNoResponse()[1] }} Pelanggan</small>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-md-0 mb-2">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="customRadioTemp7">
                                    <input name="customRadioTemp" class="form-check-input" type="radio" wire:model.live="category_percentage" value="no-response" id="customRadioTemp7" {{ $category_percentage == 'no-response' ? "checked" : "" }}>
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">E-Commerce</span>
                                        {{-- <span class="text-muted">{{ $this->percentageNoResponse()[0] }}%</span> --}}
                                    </span>
                                    <span class="custom-option-body">
                                        {{-- <small>{{ $this->percentageNoResponse()[1] }} Pelanggan</small> --}}
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
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
                        <th class="text-center">Nomor Handphone</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Kebutuhan</th>
                        <th class="text-center">Alamat</th>
                        <th class="text-center">Toko</th>
                        <th class="text-center">Keterangan</th>
                        <th class="text-center">Response</th>
                        @if ($category_percentage == "done")
                            <th class="text-center">Total Harga</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $result)
                        <tr>
                            <td class="text-center">{{ $result->created_at->isoFormat('dddd, D MMMM Y') }}</td>
                            <td class="text-center">{{ $customers->currentPage() * $perPage - $perPage + $loop->iteration }}</td>
                            <td class="text-center">
                                @if ($result?->category == 'store')
                                    <b>Toko</b>
                                @elseif ($result?->category == 'project')
                                    <b>Proyek</b>
                                @endif
                            </td>
                            <td class="text-center">0{{ $result->phone }}</td>
                            <td class="text-center">{{ $result->name }}</td>
                            <td class="text-center">{{ $result->needs }}</td>
                            <td class="text-center">{{ $result->address }}</td>
                            <td class="text-center">{{ $result->store }}</td>
                            <td class="text-center">{{ $result->description }}</td>
                            <td class="text-center">
                                @if ($result->response == 'no-response')
                                    <span class="badge rounded-pill bg-dark bg-glow">Tidak Respon (Telp)</span>
                                @elseif ($result->response == 'going-store-looking-stock')
                                    <span class="badge rounded-pill bg-warning bg-glow">Menuju Toko / Lihat Barang</span>
                                @elseif ($result->response == 'whatsapp')
                                    <span class="badge rounded-pill bg-warning bg-glow">Whatsapp</span>
                                @elseif ($result->response == 'store')
                                    <span class="badge rounded-pill bg-info bg-glow">Toko</span>
                                @elseif ($result->response == 'stock-empty-awaiting-stock')
                                    <span class="badge rounded-pill bg-warning bg-glow">Barang Kosong, Masih Menunggu</span>
                                @elseif ($result->response == 'only-question')
                                    <span class="badge rounded-pill bg-warning bg-glow">Hanya Bertanya</span>
                                @elseif ($result->response == 'used-other-product')
                                    <span class="badge rounded-pill bg-facebook bg-glow">Menggunakan Produk Lain</span>
                                @elseif ($result->response == 'not-yet-development')
                                    <span class="badge rounded-pill bg-warning bg-glow">Belum Pembangunan</span>
                                @elseif ($result->response == 'done')
                                    <span class="badge rounded-pill bg-success bg-glow">Selesai</span>
                                @endif
                            </td>
                            @if ($category_percentage == "done")
                                <td class="text-center"><b>Rp. {{ number_format($result->total_price, 0, ',', '.') }}</b></td>
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
                <div class="col-lg-6 col-12">Menampilkan {{ $customers->firstItem() }} sampai {{ $customers->lastItem() }} dari {{ $customers->total() }} hasil</div>
                <div class="d-flex justify-content-end col-lg-6 col-12">{{ $customers->links('vendor.livewire.simple-tailwind') }}</div>
            </div>
        </div>
    </div>
</div>
