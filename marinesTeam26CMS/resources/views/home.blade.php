@extends('layouts.app')
@section('nav-top')
@include('parts.nav.top')
@endsection
@section('title', '管理者ログイン')
@section('class', 'justify-content-center')
@section('main')
<div class="container container-home">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Dashboard</div>
        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif
          @can('isAdmin')
          <div class="btn btn-success btn-lg">
            <a class="text-warning text-decoration-none" href="{{ url('dashboard') }}">You have Admin Access to <span style=" font-weight: 700; " class="text-danger text-bold">dashboard</span></a>
          </div>
          @elsecan('isManager')
          <div class="btn btn-success btn-lg">
            <a class="text-warning text-decoration-none" href="{{ url('dashboard') }}">You have Manager Access  to <span style=" font-weight: 700; " class="text-danger text-bold">dashboard</span></a>
          </div>
          @else
          <div class="btn btn-success btn-lg">
            <a class="text-warning text-decoration-none" href="{{ url('dashboard') }}">You have User Access  to <span style=" font-weight: 700; " class="text-danger text-bold">dashboard</span></a>
          </div>
          @endcan
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
  .container-home {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>
