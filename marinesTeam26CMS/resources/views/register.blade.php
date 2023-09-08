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
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="card border-0">
        <div class="card-header">{{ __('登録') }}</div>
        <div class="card-body">
          <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row mb-3">
              <label for="sort_no" class="col-md-4 col-form-label text-md-end">{{ __('sort_no') }}</label>
              <div class="col-md-6">
                <input id="sort_no" type="text" class="form-control @error('sort_no') is-invalid @enderror"
                  name="sort_no" value="{{ old('sort_no') }}" required autocomplete="name" autofocus>
                @error('sort_no')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="row mb-3">
              <label for="user_id" class="col-md-4 col-form-label text-md-end">{{ __('user_id') }}</label>
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
              <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
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
            <div class="row mb-3">
              <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password')
                }}</label>
              <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                  autocomplete="new-password">
              </div>
            </div>
            <div class="row mb-3">
              <label for="user_name" class="col-md-4 col-form-label text-md-end">{{ __('user_name') }}</label>
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
              <label for="permission" class="col-md-4 col-form-label text-md-end">{{ __('permission') }}</label>
              <div class="col-md-6">
                <input id="permission" type="text" class="form-control @error('permission') is-invalid @enderror"
                  name="permission" value="{{ old('permission') }}" required autocomplete="permission" autofocus>
                @error('permission')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="row mb-3">
              <label for="created_at" class="col-md-4 col-form-label text-md-end">{{ __('created_at') }}</label>
              <div class="col-md-6">
                <input id="created_at" type="text" class="form-control @error('created_at') is-invalid @enderror"
                  name="created_at" value="{{ old('created_at') }}" required autocomplete="created_at" autofocus>
                @error('created_at')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="row mb-3">
              <label for="create_user" class="col-md-4 col-form-label text-md-end">{{ __('create_user') }}</label>
              <div class="col-md-6">
                <input id="create_user" type="text" class="form-control @error('create_user') is-invalid @enderror"
                  name="create_user" value="{{ old('create_user') }}" required autocomplete="create_user" autofocus>
                @error('create_user')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="row mb-3">
              <label for="updated_at" class="col-md-4 col-form-label text-md-end">{{ __('updated_at') }}</label>
              <div class="col-md-6">
                <input id="updated_at" type="text" class="form-control @error('updated_at') is-invalid @enderror"
                  name="updated_at" value="{{ old('updated_at') }}" required autocomplete="updated_at" autofocus>
                @error('updated_at')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="row mb-3">
              <label for="update_user" class="col-md-4 col-form-label text-md-end">{{ __('update_user') }}</label>
              <div class="col-md-6">
                <input id="update_user" type="text" class="form-control @error('update_user') is-invalid @enderror"
                  name="update_user" value="{{ old('update_user') }}" required autocomplete="update_user" autofocus>
                @error('update_user')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="row mb-3">
              <label for="deleted_at" class="col-md-4 col-form-label text-md-end">{{ __('deleted_at') }}</label>
              <div class="col-md-6">
                <input id="deleted_at" type="text" class="form-control @error('deleted_at') is-invalid @enderror"
                  name="deleted_at" value="{{ old('deleted_at') }}" required autocomplete="deleted_at" autofocus>
                @error('deleted_at')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="row mb-3">
              <label for="delete_user" class="col-md-4 col-form-label text-md-end">{{ __('delete_user') }}</label>
              <div class="col-md-6">
                <input id="delete_user" type="text" class="form-control @error('delete_user') is-invalid @enderror"
                  name="delete_user" value="{{ old('delete_user') }}" required autocomplete="delete_user" autofocus>
                @error('delete_user')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            <div class="row mb-3">
            </div <div class="row mb-0">
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
