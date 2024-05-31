<div class="modal fade modal-xl" id="modal-detail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Detail Pesanan</h1>
                <button type="button" class="btn-close" wire:click="closeModal()"></button>
            </div>
            <div class="modal-body p-3">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('assets/image/logo-drshield.png') }}" alt="..." style="max-height: 80px">
                    </div>
                    <div class="flex-grow-1 ms-3 text-center">
                        {{-- <p class="mb-1"><b>ESTIMASI PENAWARAN HARGA</b></p>
                        <p class="mb-1"><b>ATAP UPVC DR SHIELD</b></p> --}}
                        <p class="mb-1"><h4><strong>ESTIMASI PENAWARAN HARGA ATAP UPVC DR SHIELD</strong></h4></p>
                        <div class="d-flex flex-row-reverse">
                            <div class="p-2">
                                <img src="{{ asset('assets/image/Instagram_icon.webp') }}" alt="" style="max-height: 18px"> <strong>drsheild.id</strong>
                            </div>
                            <div class="p-2">
                                <img src="{{ asset('assets/image/Tiktik_icon.webp') }}" alt="" style="max-height: 18px"> <strong>drsheild.id</strong>
                            </div>
                            <div class="p-2">
                                <img src="{{ asset('assets/image/WhatsApp_icon.webp') }}" alt="" style="max-height: 18px"> <strong>08113290091</strong>
                            </div>
                          </div>
                        {{-- <div class="row">
                            <div class="col-12 col-lg-4">
                                <img src="{{ asset('assets/image/WhatsApp_icon.webp') }}" alt="" style="max-height: 18px"> <strong>08113290091</strong>
                            </div>
                            <div class="col-12 col-lg-4">
                                <img src="{{ asset('assets/image/Tiktik_icon.webp') }}" alt="" style="max-height: 18px"> <strong>drsheild.id</strong>
                            </div>
                            <div class="col-12 col-lg-4">
                                <img src="{{ asset('assets/image/Instagram_icon.webp') }}" alt="" style="max-height: 18px"> <strong>drsheild.id</strong>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <hr class="my-3">
                <div class="mb-3 d-flex">
                    <div class="">
                        <table>
                            <tr>
                                <td><b>Tanggal</b></td>
                                <td style="padding-left: 6px; padding-right: 6px"><b>:</b></td>
                                <td><b>{{ $get_order?->order_date?->isoFormat('dddd, D MMMM Y') }}</b></td>
                            </tr>
                            <tr>
                                <td><b>Kode</b></td>
                                <td style="padding-left: 6px; padding-right: 6px"><b>:</b></td>
                                <td><b>{{ $get_order?->order_code }}</b></td>
                            </tr>
                            <tr>
                                <td><b>Pelanggan</b></td>
                                <td style="padding-left: 6px; padding-right: 6px"><b>:</b></td>
                                <td><b>{{ $get_order?->customer?->name }}</b></td>
                            </tr>
                            <tr>
                                <td><b>Alamat</b></td>
                                <td style="padding-left: 6px; padding-right: 6px"><b>:</b></td>
                                <td><b>{{ $get_order?->customer?->address }}</b></td>
                            </tr>
                        </table>
                    </div>
                    <div class="ms-auto align-self-end">
                        <table>
                            <tr>
                                <td>Dicetak Tanggal</td>
                                <td style="padding-left: 6px; padding-right: 6px">
                                    <td style="padding-left: 6px; padding-right: 6px">:</td>
                                <td>{{ $get_order?->print_at?->isoFormat('dddd, D MMMM Y') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row g-3">
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
                                    {{-- @if (!Auth::user()->hasAnyRole('instruktur'))
                                        <th class="text-center">No Handphone</th>
                                    @endif --}}
                                    {{-- <th class="text-center">Status</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @if ($get_order)
                                    @forelse ($get_order?->orderDetails as $order_detail)
                                        <tr>
                                            <td class="text-start">{{ $order_detail?->need ? $order_detail?->need : '-' }}</td>
                                            <td class="text-start">{{ $order_detail?->product?->name }}</td>
                                            {{-- <td class="text-start">{{ $order_detail?->product?->name }} - <b>{{ $order_detail?->product?->profile }}</b></td> --}}
                                            <td class="text-start">{{ $order_detail?->size ? $order_detail?->size. 'm' : '-' }} </td>
                                            <td class="text-start">{{ $order_detail?->quantity }} {{ $order_detail?->quantity_unit }}</td>
                                            <td class="text-start">Rp. {{ number_format($order_detail?->price, 0, ',', '.') }} / {{ $order_detail?->price_unit == 'M' ? "M'" : ($order_detail?->price_unit == 'Lembar' ? "Lembar" : ($order_detail?->price_unit == '40 pcs' ? "Pack (40 Pcs)" : '-' )) }}</td>
                                            <td class="text-end">Rp. {{ number_format($order_detail?->total_price, 0, ',', '.') }}</td>
                                            {{-- <td class="text-start">{{ $data_order['product_name'] }} - <b>{{ $data_order['product_profile'] }}</b></td>
                                            <td class="text-center">{{ $data_order['quantity'] }}</td>
                                            <td class="text-center">Rp. {{ number_format($data_order['total_price'], 0, ',', '.') }} </td> --}}
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="fw-bold text-center">Belum Ada Data</td>
                                        </tr>
                                    @endforelse
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex">
                        <div class="p-0 flex-grow-1"><b>Grand Total</b></div>
                        <div class="p-0"><h4><b>Rp. {{ number_format($get_order?->orderDetails?->sum('total_price'), 0, ',', '.') }} </b></h4></div>
                    </div>
                </div>
                <hr class="my-2">
                <span class="text-secondary">Keterangan : <br> Kebutuhan diatas hanya estimasi berdasarkan ukuran yang telah diinformasikan oleh customer. <br> Harga tertera hanya sebagai acuan estimasi, bisa berbeda mengikuti kebijakan masing-masing toko. <br> Harga dapat berubah sewaktu-waktu</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" wire:click="closeModal()">Tutup <i class="fa-solid fa-circle-xmark fa-fw ms-2"></i></button>
                @if ($get_order?->print_at == null)
                    <button type="button" class="btn btn-success btn-sm" wire:click="printOrder('{{ $get_order?->id }}')">Cetak <i class="fa-solid fa-print fa-fw ms-2"></i></button>
                @endif
            </div>
        </div>
    </div>
</div>
