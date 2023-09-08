<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <link rel="icon" type="image/x-icon" href="{{ secure_asset('images/favicon.ico') }}">
  <title>TEAM26 CMS</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
    name='viewport' />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @include('inner.style')
  <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet" type="text/css">
  @yield('style')
</head>
<body>
  <div class="wrapper {{ $class ?? "default" }}">
    @include('inner.sidebar')
    <div class="main-panel">
      @include('inner.navbar')
      @yield('content')
      @include('inner.footer')
    </div>
  </div>
  @include('inner.script')
  @yield('script')
  @yield('script-add')
  <script type="text/javascript" src="{{ secure_asset('js/app.js') }}"></script>
</body>
</html>
