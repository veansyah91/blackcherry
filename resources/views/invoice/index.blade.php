@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-lg-4" id="form-input-card">
            <div class="card">
                <div class="card-header">

                    <div class="row justify-between d-flex">
                        <div class="col-md-6 my-auto">
                            <strong id="header-form">Invoice</strong>
                        </div>
                        <div class="col-md-6 my-auto text-right">
                            <button class="btn btn-success" id="new-invoice-button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                                Invoice Baru
                            </button>
                        </div>
                    </div>                    
                </div>

                <div class="card-body">
                    
                    <form id="form-input">
                        {{-- tanggal diinput dari back end --}}
                        <input type="hidden" id="id-daily-outcome">
                        <div class="form-group row">
                            <label for="tanggal" class="col-sm-4 col-form-label">Tanggal</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" id="tanggal" value="{{ Date('d/m/Y') }}">
                            </div>
                        </div>

                        {{-- Nomor Nota di ambil dari api vanilla javascript dengan function getInvoiceNumber --}}
                        <input type="hidden" id="id-daily-outcome">
                        <div class="form-group row">
                            <label for="nomor-nota" class="col-sm-4 col-form-label">Nomor Nota</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control" id="nomor-nota">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-4 col-form-label">Nama Pelanggan</label>
                            <div class="col-sm-8 my-auto">
                                <div class="btn-group">
                                    <input type="hidden" id="id-pelanggan">
                                    <input type="text" class="form-control" id="input-nama" disabled>
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent" onclick="cariNamaPelanggan()">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                        <a class="dropdown-item" href="#">
                                            <input type="text" class="form-control" id="cari-nama">
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <div id="daftar-cari-nama">
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="produk" class="col-sm-4 col-form-label">Produk</label>
                            <div class="col-sm-8 my-auto">
                                <div class="btn-group">
                                    <input type="hidden" id="id-produk">
                                    <input type="text" class="form-control" id="nama-produk" disabled>
                                    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent"
                                    onclick="cariNamaProduk()">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference">
                                        <a class="dropdown-item" href="#">
                                            <input type="text" class="form-control" id="cari-produk">
                                        </a>
                                        <div id="daftar-cari-produk">
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="input-harga" class="col-sm-4 col-form-label">Harga Satuan</label>
                            <div class="col-sm-8 my-auto">
                                <input type="number" class="form-control" id="input-harga">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="qty" class="col-sm-4 col-form-label">Qty</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="qty" value="1">
                            </div>
                        </div>

                        <button type="button" id="submit-form" class="btn btn-primary btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
                                <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                            Tambah Belanja 
                        </button>
                        
                    </form>
                    
                </div>
            </div>
        </div>
        <div class="col-lg-5  mt-2 mt-md-0" id="main-content">
            <div class="card">
                <div class="card-header">

                    <div class="row justify-between d-flex">
                        <div class="col-md-6 my-auto text-center text-lg-left my-sm-1 mb-sm-2">
                            <strong>{{ __('Detail Invoice') }}</strong>
                        </div>

                        <div class="col-md-6 my-auto text-center text-md-right">
                            Nomor Invoice: <span id="keterangan-nomor-nota"></span>
                        </div>
                    </div>
                    
                </div>

                <div class="alert alert-success d-none" role="alert" id="success-alert">
                    <div class="row justify-between">
                        <div class="col-8">
                            <Strong>Berhasil</Strong> <span id="status-alert"></span> Pengeluaran.
                        </div>
                        <div class="col-4 text-right">
                            <button type="button" class="close" id="close-success-alert">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <table class="table table-responsive table-sm">
                        <thead>
                            <th class="text-center">#</th>
                            <th class="text-center">Nama Produk</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Total</th>
                            <th></th>
                        </thead>
                        <tbody class="table-body">
                            
                        </tbody>
                    </table>
                    
                </div>

                <div class="card-footer">

                    <div class="row justify-between d-flex">
                        <div class="col-md-4 my-auto text-center text-lg-left my-sm-1 mb-sm-2">
                            <strong>{{ __('Total') }}</strong>
                        </div>

                        <div class="col-md-4 my-auto text-center text-md-right mt-sm-1 mb-sm-2 my-lg-auto">
                            <h4>
                                Rp. <span id="total-belanja"></span> 
                            </h4>
                        </div>

                        <div class="col-md-4 my-auto text-center text-md-right mt-sm-1 mb-sm-2">
                            <Button class="btn btn-success" id="bayar-button">
                                Bayar
                            </Button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-2">
        <div class="col-10 col-lg-6" id="detail-today-card">
            <div class="card">
                <div class="card-header">
                    <strong>Penjualan Hari Ini</strong>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <th class="text-center">#</th>
                            <th class="text-center">Nomor Nota</th>
                            <th class="text-center">Nama Pelanggan</th>
                            <th class="text-center">Total Belanja</th>
                            <th class="text-center">Status</th>
                            <th></th>
                        </thead>
                        <tbody id="detail-table">
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="row justify-content-between">
                        <div class="col-6 my-auto">
                            Total
                        </div>
                        <div class="col-6 text-right">
                            Rp. <Strong id="total-today" style="font-size: 2em"></Strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 d-none col-lg-6" id="detail-card-2">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between">
                        <div class="col my-auto">
                            <strong>Detail Invoice</strong>
                        </div>
                        <div class="col text-right">
                            <button class="btn btn-primary" id="bayar-button-2">
                                Bayar
                            </button>
                            <button class="btn btn-success" id="back-to-today-detail-button">
                                Kembali
                            </button>
                        </div>
                    </div>
                    
                </div>
                <div class="card-body">
                    <table class="table table-sm ">
                        <thead>
                            <th class="text-center">#</th>
                            <th class="text-center">Nama Produk</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Total</th>
                            <th></th>
                        </thead>
                        <tbody id="detail-invoice-table">
                            
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="row justify-content-between">
                        <div class="col-lg-6 my-auto">
                            Total
                        </div>
                        <div class="col-lg-6 text-lg-right">
                            Rp. <Strong id="total-invoice-detail" style="font-size: 2em"></Strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h2>Yakin Hapus Data?</h2>
            </div> 
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <a href="#main-content" type="button" class="btn btn-primary" id="confirm-modal">Hapus</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('/js/income-invoice/index.js') }}"></script>
@endsection