@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" id="form-input-card">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">

                    <div class="row justify-between d-flex">
                        <div class="col-md-12 my-auto">
                            <strong id="header-form">Simpan Pemasukan Bulanan</strong>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    
                    <form id="form-input">
                        <input type="hidden" id="id-daily-outcome">
                        <div class="form-group">
                            <label for="mulai">Awal Tanggal</label>
                            <input type="date" class="form-control" id="mulai" name="mulai">
                            <small id="validasi-tanggal-awal" class="form-text text-danger d-none">Tanggal Harus Diisi Dengan Benar</small>
                        </div>
                        <div class="form-group">
                            <label for="akhir">Akhir Tanggal</label>
                            <input type="date" class="form-control" id="akhir" name="akhir">
                            <small id="validasi-tanggal-akhir" class="form-text text-danger d-none">Tanggal Harus Diisi Dengan Benar</small>
                        </div>
                        <div class="form-group">
                            <label for="bulan">Bulan</label>
                            <select class="custom-select" name="bulan" id="bulan">
                                <option selected>Pilih Bulan</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <input type="text" class="form-control" id="tahun" name="tahun">
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
                            <strong>{{ __('Pengeluaran Bulanan') }}</strong>
                        </div>
                    </div>
                    
                </div>

                <div class="alert alert-success d-none" role="alert" id="success-alert">
                    <div class="row justify-between">
                        <div class="col-8">
                            <Strong>Berhasil</Strong> <span id="status-alert"></span> Pemasukan Bulanan.
                        </div>
                        <div class="col-4 text-right">
                            <button type="button" class="close" id="close-success-alert">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body mx-auto">

                    <table class="table table-responsive">
                        <thead>
                            <th class="text-center">#</th>
                            <th class="text-center">Tahun</th>
                            <th class="text-center">Bulan</th>
                            <th class="text-center">Jumlah</th>
                            <th></th>
                        </thead>
                        <tbody id="table-body">
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/monthly-income/api.js') }}"></script>
    <script src="{{ asset('js/monthly-income/index.js') }}"></script>
@endsection