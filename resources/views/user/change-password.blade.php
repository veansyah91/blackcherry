@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" id="index">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

                    <div class="row justify-between d-flex">
                        <div class="col-md-6 my-auto text-lg-left text-sm-center my-sm-1 mb-sm-2">
                            <strong>{{ __('Ubah Password') }}</strong>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form id="form-input" method="POST" action="/user/change-password">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="password">Masukkan Password Baru</label>
                            <input type="text" class="form-control" id="password" name="password" required>
                        </div>

                        <button type="submit" id="submit-form" class="btn btn-primary">Daftar</button>
                    </form>
                </div>
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