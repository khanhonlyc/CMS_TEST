@extends('layouts.app')
@section('nav-top')
@include('parts.nav.top')
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="{{ secure_asset('css/metro-all.min.css') }}">
@endsection
@section('title', '登録')
@section('class', 'justify-content-center')
@section('main')
<div class="container container-register">
  <div class="row justify-content-center w-50">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 border">
      <div class="card border-0">
        <div class="card-header">{{ __('登録') }}</div>
        <div class="card-body">
          <form method="POST" action="{{ route('registration.store') }}">
            @csrf
            <div class="row mb-3">
              <label for="user_id" class="col-md-4 col-form-label text-md-end">{{ __('ID/メールアドレス') }}</label>
              <div class="col-md-6">
                <input id="user_id" type="text" class="form-control @error('user_id') is-invalid @enderror"
                  name="user_id" value="{{ old('user_id') }}" required autocomplete="name" autofocus>
                @error('user_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="row mb-3">
              <label for="user_name" class="col-md-4 col-form-label text-md-end">{{ __('名前') }}</label>
              <div class="col-md-6">
                <input id="user_name" type="text" class="form-control @error('user_name') is-invalid @enderror"
                  name="user_name" value="{{ old('user_name') }}" required autocomplete="user_name" autofocus>
                @error('user_name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="row mb-3">
              <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('パスワード') }}</label>
              <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                  name="password" required autocomplete="new-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="col-md-6 offset-md-4">
              <button type="submit" class="btn btn-primary">
                {{ __('Register') }}
              </button>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
@section('nav-footer')
@include('parts.nav.footer')
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.korzh.com/metroui/v4.5.1/js/metro.min.js"></script>
<script>
  $(".datepicker").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i:ss"
  });
  $(".datepicker2").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i:ss"
  });
</script>
@endsection
<style type="text/css">
  #app {
    display: flex;
    flex-direction: column;
    height: 100vh;
  }
  .main {
    flex: 1;
    display: flex;
    flex-direction: column;
  }
  .container-register {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>
