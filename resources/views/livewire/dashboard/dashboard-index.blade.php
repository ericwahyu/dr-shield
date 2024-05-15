@section('title', 'Dashboard')
<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="d-flex align-items-center">
        <div>
            <h3 class="fw-semibold mb-0">Dashboard</h3>
        </div>
        {{-- <div class="ms-auto">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal">Tambah <i class="fa-solid fa-circle-plus fa-fw ms-2"></i></button>
        </div> --}}
    </div>
    <hr class="my-3">
    <div class="row">
        <div class="col-xl-12 mb-4 col-lg-7 col-12">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between mb-3">
                    <h5 class="card-title mb-0">Statistik Pelanggan</h5>
                    {{-- <small class="text-muted">Updated 1 month ago</small> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-md-2 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-warning me-3 p-2"><i class="fa-solid fa-users-line fs-5" style="color: #FCAB5D"></i></div>
                                <div class="card-info">
                                    <h5 class="mb-0"><b>{{ $this->countAllCustomer() }}</b></h5>
                                    <small>Pelanggan</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-danger me-3 p-2"><i class="fa-solid fa-user-slash fs-5" style="color: rgb(128, 0, 0)"></i></div>
                                <div class="card-info">
                                    <h5 class="mb-0"><b>{{ $this->countNoResponse() }}</b></h5>
                                    <small>Tidak Respon</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-info me-3 p-2"><i class="fa-solid fa-comments-dollar fs-5" style="color: rgb(7, 148, 230)"></i></div>
                                <div class="card-info">
                                    <h5 class="mb-0"><b>{{ $this->countNegotiation() }}</b></h5>
                                    <small>Negosiasi</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-dark me-3 p-2"><i class="fa-solid fa-store fs-5"></i></div>
                                <div class="card-info">
                                    <h5 class="mb-0"><b>{{ $this->countStore() }}</b></h5>
                                    <small>Toko</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-facebook me-3 p-2"><i class="fa-solid fa-arrows-spin fs-5"></i></div>
                                <div class="card-info">
                                    <h5 class="mb-0"><b>{{ $this->countOtherProduct() }}</b></h5>
                                    <small>Produk Lain</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-success me-3 p-2"><i class="fa-solid fa-hexagon-check fs-5" style="color: green"></i></div>
                                <div class="card-info">
                                    <h5 class="mb-0"><b>{{ $this->countDone() }}</b></h5>
                                    <small>Selesai</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-7 mb-4 col-lg-6 col-12">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between mb-3">
                    <h5 class="card-title mb-0">Statistik Pesanan</h5>
                    {{-- <small class="text-muted">Updated 1 month ago</small> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-md-4 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-info me-3 p-2"><i class="fa-solid fa-bags-shopping fs-5" style="color: rgb(7, 148, 230)"></i></div>
                                <div class="card-info">
                                    <h5 class="mb-0"><b>{{ $this->countAllOrder() }}</b></h5>
                                    <small>Total Pesanan</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-warning me-3 p-2"><i class="fa-solid fa-people-roof fs-5" style="color: #FCAB5D"></i></i></div>
                                <div class="card-info">
                                    <h5 class="mb-0"><b>{{ $this->countRoofOrder() }}</b></h5>
                                    <small>Pesanan Genteng</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-dark me-3 p-2"><i class="fa-solid fa-people-roof fs-5"></i></i></div>
                                <div class="card-info">
                                    <h5 class="mb-0"><b>{{ $this->countUpvcOrder() }}</b></h5>
                                    <small>Pesanan UPVC</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-5 mb-4 col-lg-6 col-12">
            <div class="card h-100">
                <div class="card-header">
                    <div class="d-flex justify-content-between mb-3">
                    <h5 class="card-title mb-0">Produk</h5>
                    {{-- <small class="text-muted">Updated 1 month ago</small> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-md-6 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-warning me-3 p-2"><i class="fa-solid fa-people-roof fs-5" style="color: #FCAB5D"></i></div>
                                <div class="card-info">
                                    <h5 class="mb-0"><b>{{ $this->productRoof() }}</b></h5>
                                    <small>Item Genteng</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-dark me-3 p-2"><i class="fa-solid fa-people-roof fs-5"></i></div>
                                <div class="card-info">
                                    <h5 class="mb-0"><b>{{ $this->productUpvc() }}</b></h5>
                                    <small>Item UPVC</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
