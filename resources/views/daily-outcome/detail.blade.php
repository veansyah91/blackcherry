@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" id="form-input-card">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">

                    <div class="row justify-between d-flex">
                        <div class="col-md-12 my-auto">
                            <strong id="header-form">Detail Pengeluaran Harian</strong>
                        </div>
                    </div>

                    
                    
                </div>

                <div class="card-body">
                    
                    <form id="form-input">
                        <input type="hidden" id="id-daily-outcome">
                        <div class="form-group">
                            <label for="tanggal">Awal Tanggal</label>
                            <input type="date" class="form-control" id="mulai" name="mulai">
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Akhir Tanggal</label>
                            <input type="date" class="form-control" id="akhir" name="akhir">
                        </div>

                        <button type="button" id="submit-form" class="btn btn-primary">Cari</button>
                    </form>
                    
                </div>
            </div>
        </div>

        <div class="col-lg-5  mt-2 mt-md-0" id="history-card">
            <div class="card">
                <div class="card-header">

                    <div class="row justify-between d-flex">
                        <div class="col-md-12 my-auto text-center text-lg-left my-sm-1 mb-sm-2">
                            <strong>{{ __('Riwayat Pengeluaran Harian') }}</strong>
                        </div>
                    </div>
                    
                </div>

                <div class="card-body mx-auto">

                    <table class="table table-responsive">
                        <tbody id="table-body-1">
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>

        <div class="col-lg-5  mt-2 mt-md-0 d-none" id="detail-card">
            <div class="card">
                <div class="card-header">

                    <div class="row justify-between d-flex">
                        <div class="col-md-6 my-auto text-center text-lg-left my-sm-1 mb-sm-2">
                            <strong>{{ __('Detail') }}</strong>
                        </div>
                        <div class="col-md-6 my-auto text-center text-lg-right my-sm-1 mb-sm-2">
                            <button class="btn btn-sm btn-success" onclick="showHistory()">Kembali</button>
                        </div>
                    </div>
                    
                </div>

                <div class="card-body mx-auto">

                    <table class="table table-responsive">
                        <tbody id="table-body-2">
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/daily-outcome/detail.js') }}"></script>
@endsection