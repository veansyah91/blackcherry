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
                    
                    <div class="text-center d-none" id="show-more-parent">
                        <button class="btn btn-primary w-100" id="btn-show-more">Tampilkan Lebih</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5  mt-2 mt-md-0 d-none" id="detail-content">
            <div class="card">
                <div class="card-header">

                    <div class="row justify-between d-flex">
                        <div class="col-md-6 my-auto text-center text-lg-left my-sm-1 mb-sm-2">
                            <strong>Rincian Pemasukan Harian</strong>
                        </div>
                        <div class="col-md-6 my-auto text-center text-lg-right my-sm-1 mb-sm-2">
                            <button class="btn btn-sm btn-success" id="cancel-show-detail">Kembali</button>
                        </div>
                    </div>
                    
                </div>
                
                <div class="card-body" id="detail-content-body">
                    <div class="spinner-border" role="status">
                        
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