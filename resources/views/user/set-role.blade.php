@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" id="index">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

                    <div class="row justify-between d-flex">
                        <div class="col-md-6 my-auto text-lg-left text-sm-center my-sm-1 mb-sm-2">
                            <strong>{{ __('Role Pengguna') }}</strong>
                        </div>
                    </div>
                    
                </div>

                <div class="card-body">
                    <table class="table table-sm" id="table-data">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Role</th>
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

    <div class="row justify-content-center d-none" id="set-role">
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
                        <input type="hidden" id="user-id">

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                            <small id="validasi-nama" class="form-text text-danger d-none">Nama Harus Diisi</small>
                        </div>

                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="custom-select" id="role">
                            </select>
                        </div>

                        <button type="submit" id="submit-form" class="btn btn-primary">Daftar</button>
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
    <script src="{{ asset('js/role/api.js') }}"></script>
    <script src="{{ asset('js/set-role/index.js') }}"></script>
    <script src="{{ asset('js/set-role/api.js') }}"></script>
@endsection