@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" id="form-input-card">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">

                    <div class="row justify-between d-flex">
                        <div class="col-md-6 my-auto">
                            <strong id="header-form"></strong>
                        </div>
                        <div class="col-md-6 text-right d-none" id="cancel-edit-form">
                            <button class="btn btn-success btn-sm" id="cancel-button">Batal</button>
                        </div>
                    </div>

                    
                    
                </div>

                <div class="card-body">
                    
                    <form id="form-input">
                        <input type="hidden" id="id-daily-outcome">
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal">
                            <small id="validasi-tanggal" class="form-text text-danger d-none">Tanggal Harus Diisi Dengan Benar</small>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah">
                            <small id="validasi-jumlah" class="form-text text-danger d-none">Jumlah Harus Diisi Dengan Benar</small>
                        </div>

                        <div class="form-group">
                            <label for="alamat">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan">
                            <small id="validasi-keterangan" class="form-text text-danger d-none">Keterangan Harus Diisi</small>
                        </div>

                        <button type="button" id="submit-form" class="btn btn-primary">Simpan</button>
                    </form>
                    
                </div>
            </div>
        </div>
        <div class="col-lg-5  mt-2 mt-md-0" id="main-content">
            <div class="card">
                <div class="card-header">

                    <div class="row justify-between d-flex">
                        <div class="col-md-6 my-auto text-center text-lg-left my-sm-1 mb-sm-2">
                            <strong>{{ __('Pengeluaran Harian') }}</strong>
                        </div>

                        <div class="col-md-6 my-auto text-center text-md-right mt-sm-1 mb-sm-2">
                            {{ Date('d-m-Y') }}
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

                    <table class="table table-sm table-responsive">
                        <thead>
                            <th class="text-center">#</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Keterangan</th>
                            <th></th>
                        </thead>
                        <tbody id="table-body">
                        </tbody>
                    </table>
                    
                </div>

                <div class="card-footer">

                    <div class="row justify-between d-flex">
                        <div class="col-md-6 my-auto text-center text-lg-left my-sm-1 mb-sm-2">
                            <strong>{{ __('Total') }}</strong>
                        </div>

                        <div class="col-md-6 my-auto text-center text-md-right mt-sm-1 mb-sm-2">
                            <h4 id="total">

                            </h4>
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
    <script src="{{ asset('js/daily-outcome/index.js') }}"></script>
@endsection