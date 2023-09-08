<nav style="display:none" class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand shimmer" href="{{ url('/') }}">
      {{ config('app.name', 'Laravel') }}
    </a>
    <span class="btn btn-outline-white border rounded-4 px-4">@if(config('app.env') == 'staging') STG環境 @elseif(config('app.env') == 'production') 本番環境 @else ...  @endif</span>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left Side Of Navbar -->
      <ul class="navbar-nav me-auto">
      </ul>
      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ms-auto">
        <!-- Authentication Links -->
        @guest
        @if (Route::has('login'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
        </li>
        @endif
        @if (Route::has('register'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">{{ __('登録') }}</a>
        </li>
        @endif
        @else
        <li class="nav-item dropdown d-flex">
          <a id="navbarDropdown" class="nav-link d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->user_name }}
          </a>
          <div id="navbarDropdownsub" class="nav-link  btn btn-outline-white border rounded-4 px-4 d-flex align-items-center" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              {{ __('ログアウト') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </div>
        </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
<section class="header">
  <div class="container-fluid">
    <div class="logo">
      <a href="{{ url('/') }}">
        <img src="{{ secure_asset('images/cmslogo.svg') }}" alt="">
      </a>
      <a class="btn-custom" href="#">@if(config('app.env') == 'staging') STG環境 @elseif(config('app.env') == 'production') 本番環境 @else ...  @endif</a>
    </div>
  </div>
</section>
