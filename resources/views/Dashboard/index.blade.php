@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-10">
            <h1>Dashboard</h1>
        </div>
    </div>

    <div class="row justify-content-center" id="index">
        <div class="col-lg-5">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-1 bg-primary">
                        
                    </div>
                    <div class="col-11">
                        <div class="card-body">
                            <h4 class="card-title"><strong>Pemasukan/Omset</strong></h4>
                            <h2 class="text-lg-right text-center" id="last-income"></h2>
                            <p class="text-lg-right text-center" id="detail-income"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-1 bg-danger">
                        
                    </div>
                    <div class="col-11">
                        <div class="card-body">
                            <h4 class="card-title"><strong>Pengeluaran</strong></h4>
                            <h2 class="text-lg-right text-center" id="last-outcome"></h2>
                            <p class="text-lg-right text-center" id="detail-outcome"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10 col-12">
            <h3>Analisa</h3>
            <canvas id="myChart">

            </canvas>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/chart/chart.js') }}"></script>
    <script src="{{ asset('js/dashboard/index.js') }}"></script>
    <script src="{{ asset('js/dashboard/api.js') }}"></script>
@endsection