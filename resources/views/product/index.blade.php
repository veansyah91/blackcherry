@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" id="index">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

                    <div class="row justify-between d-flex">
                        <div class="col-md-4 my-auto text-lg-left text-sm-center my-sm-1 mb-sm-2">
                            <strong>{{ __('Produk') }}</strong>
                        </div>
                        
                        <div class="col-md-4 my-auto mt-sm-1 mb-sm-2">
                            <div class="input-group mb-3 my-auto">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary" type="button" id="submit-search">search</button>
                                </div>
                                <input type="search" class="form-control" placeholder="cari produk" aria-label="Example text with button addon" aria-describedby="button-addon1" id="search-input">
                            </div>
                        </div>

                        <div class="col-md-4 my-auto text-right mt-sm-1 mb-sm-2">
                            <button class="btn btn-primary btn-sm" id="add-button">Tambah Produk</button>
                        </div>
                    </div>
                    
                </div>

                <div class="alert alert-success d-none" role="alert" id="success-alert">
                    <div class="row justify-between">
                        <div class="col-6">
                            <Strong>Berhasil</Strong> <span id="status-alert"></span> Produk.
                        </div>
                        <div class="col-6 text-right">
                            <button type="button" class="close" id="close-success-alert">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    
                </div>

                <div class="card-body">
                    <table class="table table-sm" id="table-data">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Jenis Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Kode</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            
                        </tbody>
                    </table>

                    {{-- Button Show More --}}
                    <div class="text-center" id="show-more">
                        <button class="btn btn-link" onClick="showMoreFunc()">Tampilkan Lebih Banyak</button>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center d-none" id="card-form-input">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">

                    <div class="row justify-between">
                        <div class="col-md-6">
                            <strong><span id="header-card"></span></strong> 
                        </div>
                        <div class="col-md-6 text-right">
                            <button class="btn btn-success btn-sm" id="cancel-button">Batal</button>
                        </div>
                    </div>

                </div>

                <div class="card-body">
                    
                    <form id="form-input">
                        <input type="hidden" id="id-product">
                        <div class="form-group">
                            <label for="kode">Kode</label>
                            <input type="text" class="form-control" id="kode" name="kode">
                            <small id="validasi-kode-produk" class="form-text text-danger d-none">Kode Harus Diisi</small>
                        </div>

                        <div class="form-group">
                            <label for="nama_produk">Nama Produk</label>
                            <input type="text" class="form-control" id="nama-produk" name="nama_produk">
                            <small id="validasi-nama-produk" class="form-text text-danger d-none">Nama Harus Diisi</small>
                        </div>

                        <div class="form-group">
                            <label for="jenis_produk">Jenis Produk</label>
                            <select class="form-control" id="jenis-produk" name="jenis_produk">
                                <option value="makanan" selected>Makanan</option>
                                <option value="minuman">Minuman</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="harga" class="form-control" id="harga" value="0" name="harga">
                            <small id="validasi-nama-produk" class="form-text text-danger d-none">Harga Harus Diisi</small>
                        </div>
                        <button type="button" id="submit-form" class="btn btn-primary">Submit</button>
                    </form>

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
                <button type="button" class="btn btn-primary" id="confirm-modal">Hapus</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/product/index.js') }}"></script>
@endsection