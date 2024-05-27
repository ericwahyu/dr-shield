@section('title', 'Buat Pesanan')
<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="d-flex align-items-center">
        <div>
            <h3 class="fw-semibold mb-0">Buat Pesanan</h3>
        </div>
        {{-- <div class="ms-auto">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">Tambah <i class="fa-solid fa-circle-plus fa-fw ms-2"></i></button>
        </div> --}}
    </div>
    <hr class="my-3">
    <div class="row">
        <div class="col-12 col-lg-4">
            <div class="card mb-4">
                {{-- <h5 class="card-header"></h5> --}}
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-7">
                            <div class="mb-3">
                                <label for="customer_id" class="form-label">Pelanggan <span class="text-danger">*</span></label>
                                <select class="form-select @error('customer_id') is-invalid @enderror" id="customer_id" wire:model="customer_id" aria-label="Default select example">
                                    <option value=""selected style="display: none">-- Pilih Pelanggan --</option>
                                    <optgroup label="Toko">
                                        @foreach ($customers?->where('category', 'store') as $store_customer)
                                            <option value="{{ $store_customer?->id }}">{{ $store_customer?->name }} &ensp; - &ensp; 0{{ $store_customer?->phone }} &ensp; - &ensp; {{ $store_customer?->address }}</option>
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Proyek">
                                        @foreach ($customers?->where('category', 'project') as $store_customer)
                                            <option value="{{ $store_customer?->id }}">{{ $store_customer?->name }} &ensp; - &ensp; 0{{ $store_customer?->phone }} &ensp; - &ensp; {{ $store_customer?->address }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                                @error('customer_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-lg-5">
                            <div class="mb-3">
                                <label for="order_date" class="form-label">Tanggal Pesanan <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('order_date') is-invalid @enderror" id="order_date" wire:model="order_date">
                                @error('order_date')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="product_id" class="form-label">Produk <span class="text-danger">*</span></label>
                            <select class="form-select @error('product_id') is-invalid @enderror" id="product_id" wire:model.live="product_id" aria-label="Default select example">
                                <option value=""selected style="display: none">-- Pilih Produk --</option>
                                <optgroup label="Genteng">
                                    @foreach ($products?->where('calculated', 'proof') as $proof_product)
                                        <option value="{{ $proof_product?->id }}">{{ $proof_product?->name }} &ensp; - &ensp; {{ $proof_product?->profile }}</option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="UPVC">
                                    @foreach ($products?->where('calculated', 'upvc')  as $upvc_product)
                                        <option value="{{ $upvc_product?->id }}"">{{ $upvc_product?->name }} &ensp; - &ensp; {{ $upvc_product?->profile }}</option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="Aksesoris">
                                    @foreach ($products?->whereIn('calculated', ['accessories', 'pieces'])  as $accessories_product)
                                        <option value="{{ $accessories_product?->id }}"">{{ $accessories_product?->name }} &ensp; - &ensp; {{ $accessories_product?->profile }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                            @error('product_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <hr class="my-4">
                        <div class="row">
                            @if (in_array($get_product?->calculated, ['proof', 'upvc']))
                                <div class="col-md-5" wire:key="{{ rand() }}">
                                    <div class="mb-3">
                                        <label for="length" class="form-label">Ukuran Panjang <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('length') is-invalid @enderror" id="length" wire:model.live.debounce.2000ms="length">
                                        <div id="defaultFormControlHelp" class="form-text">Masukkan Satuan M (meter)</div>
                                        @error('length')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if (in_array($get_product?->calculated, ['proof', 'upvc', 'accessories']))
                                <div class="col-md-5" wire:key="{{ rand() }}">
                                    <div class="mb-3">
                                        <label for="width" class="form-label">Ukuran Lebar <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('width') is-invalid @enderror" id="width" wire:model.live.debounce.2000ms="width">
                                        <div id="defaultFormControlHelp" class="form-text">Masukkan Satuan M (meter)</div>
                                        @error('width')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if ($get_product?->calculated == 'pieces')
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label for="pieces" class="form-label">jumlah Item <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('pieces') is-invalid @enderror" id="pieces" wire:model.live.debounce.2000ms="pieces">
                                        <div id="defaultFormControlHelp" class="form-text">Masukkan Satuan Pack</div>
                                        @error('pieces')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if ($get_product && $grand_total)
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="width" class="form-label">&ensp;</label>
                                        <button type="button" class="btn btn-success btn-sm p-3"wire:click="addDataOrder()">Tambah</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        {{-- <hr class="my-4"> --}}
                        @if ($get_product?->calculated == 'proof' && $grand_total)
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="list-group list-group-flush">
                                        <span class="list-group-item">@if ($length && $width && $get_product) ({{ $length_mm }} : {{ $length_product }}) x ({{ $width_mm }} : {{ $width_product }}) @endif</span>
                                        <span class="list-group-item">@if ($length && $width && $get_product) {{ $length_value_1 }} x {{ $width_value_1 }} @endif</span>
                                        <span class="list-group-item">@if ($length && $width && $get_product) {{ $length_roundup }} x {{ $width_roundup }} @endif</span>
                                        <span class="list-group-item">@if ($length && $width && $get_product) {{ $count_item }} Lembar @endif</span>
                                        <span class="list-group-item"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="list-group list-group-flush">
                                        <span class="list-group-item">@if ($length && $width && $get_product) {{ $count_item }} x Rp. {{ number_format($get_product?->price, 0, ',', '.') }} (per Lembar) @endif</span>
                                        <span class="list-group-item">@if ($length && $width && $get_product) <b>Rp. {{ number_format($grand_total, 0, ',', '.') }}</b> @endif</span>
                                        <span class="list-group-item"></span>
                                    </div>
                                </div>
                            </div>
                        @elseif ($get_product?->calculated == 'upvc' && $grand_total)
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="list-group list-group-flush">
                                        @if ($length > 12)
                                            <span class="list-group-item">@if ($length && $width && $get_product) ({{ $length }} : {{ $rate_roundup }}) x ({{ $width_mm }} : {{ $effective_width_product }} x {{ $rate_roundup }}) @endif</span>
                                            <span class="list-group-item">@if ($length && $width && $get_product) {{ $length_value_1 }} x ({{ $width_value_1 }} x {{ $rate_roundup }}) @endif</span>
                                            <span class="list-group-item">@if ($length && $width && $get_product) {{ $length_roundup }} x ({{ $width_roundup }} x {{ $rate_roundup }}) @endif</span>
                                            <span class="list-group-item">@if ($length && $width && $get_product) {{ $length_roundup }} x {{ $width_roundupx2 }} Lembar x Rp. {{ number_format($get_product?->price, 0, ',', '.') }} (per Meter) @endif</span>
                                            {{-- <span class="list-group-item">@if ($length && $width && $get_product) {{ $count_item }} Lembar @endif</span> --}}
                                            <span class="list-group-item"></span>
                                        @else
                                            <span class="list-group-item">@if ($length && $width && $get_product) {{ $length }} x ({{ $width_mm }} : {{ $effective_width_product }}) @endif</span>
                                            <span class="list-group-item">@if ($length && $width && $get_product) {{ $length }} x {{ $width_value_2 }} @endif</span>
                                            <span class="list-group-item">@if ($length && $width && $get_product) {{ $length }} x {{ $width_roundup }} Lembar x Rp. {{ number_format($get_product?->price, 0, ',', '.') }} (per Meter) @endif</span>
                                            {{-- <span class="list-group-item">@if ($length && $width && $get_product) {{ $count_item }} Lembar @endif</span> --}}
                                            <span class="list-group-item"></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="list-group list-group-flush">
                                        {{-- <span class="list-group-item">@if ($length && $width && $get_product) {{ $count_item }} x Rp. {{ number_format($get_product?->price, 0, ',', '.') }} (per Lembar) @endif</span> --}}
                                        <span class="list-group-item">@if ($length && $width && $get_product) <b>Rp. {{ number_format($grand_total, 0, ',', '.') }}</b> @endif</span>
                                        <span class="list-group-item"></span>
                                    </div>
                                </div>
                            </div>
                        @elseif ($get_product?->calculated == 'accessories' && $grand_total)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="list-group list-group-flush">
                                        <span class="list-group-item">@if ($width && $get_product) ({{ $width }} x 1000) : {{ $width_product }}@endif</span>
                                        <span class="list-group-item">@if ($width && $get_product) {{ $width_mm }} : {{ $width_product }}@endif</span>
                                        {{-- <span class="list-group-item">@if ($width && $get_product) {{ $count_item_roundup }} Lembar @endif</span> --}}
                                        <span class="list-group-item">@if ($width && $get_product) {{ $count_item_roundup }} Lembar x Rp. {{ number_format($get_product?->price, 0, ',', '.') }} (per {{ $get_product?->price_unit }})  @endif</span>
                                        <span class="list-group-item">@if ($width && $get_product) <b>Rp. {{ number_format($grand_total, 0, ',', '.') }}</b> @endif</span>
                                    </div>
                                </div>
                            </div>
                        @elseif ($get_product?->calculated == 'pieces' && $grand_total)
                        <div class="row">
                            <div class="col-md-12">
                                {{-- <label class="form-label">Hasil Perhitungan</span></label> --}}
                                <div class="list-group list-group-flush">
                                    {{-- <span class="list-group-item">@if ($length && $width && $get_product) ({{ $width }} x 1000) : {{ $width_product }}@endif</span> --}}
                                    {{-- <span class="list-group-item">@if ($length && $width && $get_product) {{ $width_mm }} : {{ $width_product }}@endif</span> --}}
                                    {{-- <span class="list-group-item">@if ($length && $width && $get_product) {{ $count_item_roundup }} Lembar @endif</span> --}}
                                    <span class="list-group-item">@if ($pieces && $get_product) {{ $pieces }} x Rp. {{ number_format($get_product?->price, 0, ',', '.') }} (per {{ $get_product?->price_unit }})  @endif</span>
                                    <span class="list-group-item">@if ($pieces && $get_product) <b>Rp. {{ number_format($grand_total, 0, ',', '.') }}</b> @endif</span>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title m-0 me-2">Data Pesanan</h5>
                    @if (count($data_orders) > 0)
                        <div class="ms-auto">
                            <button class="btn btn-success p-3" wire:click="saveDataOrder()">Simpan</button>
                        </div>
                    @endif
                  </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive scrollbar-x">
                                <table class="table table-bordered">
                                    <thead class="table-light">
                                        <tr>
                                            {{-- <th class="text-center" style="width: 10px;">No</th> --}}
                                            <th class="text-center">Kebutuhan</th>
                                            <th class="text-center">Tipe</th>
                                            <th class="text-center">Ukuran</th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Total</th>
                                            <th class="text-center">Aksi</th>
                                            {{-- @if (!Auth::user()->hasAnyRole('instruktur'))
                                                <th class="text-center">No Handphone</th>
                                            @endif --}}
                                            {{-- <th class="text-center">Status</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data_orders as $key => $data_order)
                                            <tr>
                                                <td class="text-center">{{ $data_order['need'] ?? '-' }}</td>
                                                <td class="text-start">{{ $data_order['product_name'] }} - <b>{{ $data_order['product_profile'] }}</b></td>
                                                <td class="text-center">{{ $data_order['size'] ? $data_order['size'].'m' : '-'  }} </td>
                                                <td class="text-center">{{ $data_order['quantity'] }} {{ $data_order['quantity_unit'] }}</td>
                                                <td class="text-center">Rp. {{ number_format($data_order['price'], 0, ',', '.') }} /{{ $data_order['price_unit'] }}</td>
                                                <td class="text-center">Rp. {{ number_format($data_order['total_price'], 0, ',', '.') }} </td>
                                                <td class="text-center">
                                                    <button class="btn btn-danger btn-sm" wire:click="deleteConfirm('{{ $key }}')" x-data="{ tooltip: 'Hapus' }" x-tooltip="tooltip"><i class="fa-solid fa-trash-alt fa-fw"></i></button>
                                                    {{-- <button class="btn btn-warning btn-sm" wire:click="edit('{{ $result?->id }}')" x-data="{ tooltip: 'Edit' }" x-tooltip="tooltip"><i class="fa-solid fa-pencil-alt fa-fw"></i></button> --}}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="fw-bold text-center">Belum Ada Data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <hr class="my-2">
                            <div class="d-flex">
                                <div class="p-1 flex-grow-1"><b>Grand Total</b></div>
                                <div class="p-1"><strong><td class="text-center">Rp. {{ number_format($final_price, 0, ',', '.') }} </td></strong></div>
                            </div>
                            {{-- <div class="list-group list-group-flush">
                                <span class="list-group-item">@if ($length && $width && $get_product) ({{ $length_mm }} : {{ $length_product }}) x ({{ $width_mm }} : {{ $width_product }}) @endif</span>
                                <span class="list-group-item">@if ($length && $width && $get_product) {{ $length_value_1 }} x {{ $width_value_1 }} @endif</span>
                                <span class="list-group-item">@if ($length && $width && $get_product) {{ $length_roundup }} x {{ $width_roundup }} @endif</span>
                                <span class="list-group-item">@if ($length && $width && $get_product) {{ $count_item }} Lembar @endif</span>
                            </div> --}}
                            {{-- @foreach ($data_orders as $key => $data_order)
                                <span class="list-group-item">ok</span>
                            @endforeach --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
