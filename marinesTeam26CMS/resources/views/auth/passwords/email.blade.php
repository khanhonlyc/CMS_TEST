@extends('layouts.app')
@section('nav-top')
 	@include('parts.nav.top')
@endsection
@section('title', '管理者ログイン')
@section('class', 'justify-content-center')
@section('main')
<div class="container container-reset">
    <div class="row justify-content-center w-50">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card border">
                <div class="card-header">{{ __('Reset Password') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
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
  .container-reset {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>
