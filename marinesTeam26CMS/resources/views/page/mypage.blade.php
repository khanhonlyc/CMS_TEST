@extends('templates.apps',['class' => 'mypage'])
@section('content')
<div class="content btn-radius-custom">
  <main class="main py-4">
    <div class="container-fluid container-fluid--custom">
      @can('isAdmin')
      @include("inner.top-page-1")
      @include("inner.top-page-2")
      @include("inner.top-page-3")
      @elsecan('isManager')
      @include("inner.top-page-1")
      @elsecan('isUser')
      @include("inner.top-page-2")
      @endcan
    </div>
  </main>
</div>
@endsection
