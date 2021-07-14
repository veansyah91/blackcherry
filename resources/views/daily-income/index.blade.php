@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" id="form-input-card">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">

                    <div class="row justify-between d-flex">
                        <div class="col-8 my-auto">
                            <strong id="header-form">Simpan Pemasukan Harian</strong>
                        </div>
                    </div>

                </div>

                <div class="card-body">
                    
                    <form id="form-input">
                        <input type="hidden" id="id-daily-outcome">
                        <div class="form-group">
                            <label for="input-tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="input-tanggal" name="tanggal">
                            <small id="validasi-tanggal" class="form-text text-danger d-none">Tanggal Harus Diisi Dengan Benar</small>
                        </div>

                        <button type="button" id="submit-form" class="btn btn-primary">Update</button>
                    </form>
                    
                </div>
            </div>
        </div>
        <div class="col-lg-5  mt-2 mt-md-0" id="main-content">
            <div class="card">
                <div class="card-header">

                    <div class="row justify-between d-flex">
                        <div class="col-md-6 my-auto text-center text-lg-left my-sm-1 mb-sm-2">
                            <strong>Rincian Pemasukan Harian</strong>
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

                    <table class="table">
                        <thead>
                            <th class="text-center">#</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Jumlah</th>
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
@endsection

@section('script')
    <script src="{{ asset('js/daily-income/api.js') }}"></script>
    <script src="{{ asset('js/daily-income/index.js') }}"></script>
@endsection