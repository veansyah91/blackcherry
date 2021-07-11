@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" id="index">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

                    <div class="row justify-between d-flex">
                        <div class="col-md-6 my-auto text-lg-left text-sm-center my-sm-1 mb-sm-2">
                            <strong>{{ __('Pengguna') }}</strong>
                        </div>

                        <div class="col-md-6 my-auto text-right mt-sm-1 mb-sm-2">
                            <button class="btn btn-primary btn-sm" id="add-button">Tambah Pengguna</button>
                        </div>
                    </div>
                    
                </div>

                <div class="alert alert-success d-none" role="alert" id="success-alert">
                    <div class="row justify-between">
                        <div class="col-6">
                            <Strong>Berhasil</Strong> <span id="status-alert"></span> Pelanggan.
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
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center d-none" id="register">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

                    <div class="row justify-between">
                        <div class="col-md-6 text-center text-lg-left">
                            <strong><span id="header-form-card"></span></strong> 
                        </div>
                        <div class="col-md-6 text-right">
                            <button class="btn btn-success btn-sm" id="cancel-button">Batal</button>
                        </div>
                    </div>

                </div>

                <div class="card-body">
                    
                    <form id="form-input">
                        <input type="hidden" id="id-user">

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                            <small id="validasi-nama" class="form-text text-danger d-none">Nama Harus Diisi</small>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email">
                            <small id="validasi-email" class="form-text text-danger d-none">Email Harus Diisi</small>
                        </div>

                        <div class="form-group">
                            <label for="password">Default Password</label>
                            <input type="text" class="form-control" id="password" name="password"
                            value="blackcherry2020">
                            <small id="validasi-password" class="form-text text-danger d-none">Password Harus Diisi</small>
                        </div>

                        <button type="button" id="submit-form" class="btn btn-primary">Daftar</button>
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
                <input type="hidden" id="id-user-delete">
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
    <script src="{{ asset('js/user/index.js') }}"></script>
    <script src="{{ asset('js/user/api.js') }}"></script>
@endsection