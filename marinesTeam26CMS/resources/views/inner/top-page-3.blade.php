<div class="items">
  <nav class="ps-0 navbar bg-secondary bg-loggedin bg-gradient bg-opacity-75 text-white">
    <div class="ps-0 container-fluid">
      <span class="navbar-brand text-dark">マスタ管理</span>
    </div>
  </nav>
  <div class="row my-3">
    <div class="col-custom">
      <a href="{{ route('fan-type.index') }}" class="btn btn-block btn-fill w-100 text-start">サイト種別マスタ設定</a>
    </div>
  </div>
</div>
<div class="items">
  <nav class="ps-0 navbar bg-secondary bg-loggedin bg-gradient bg-opacity-75 text-white">
    <div class="ps-0 container-fluid">
      <span class="navbar-brand text-dark">ログ照会</span>
    </div>
  </nav>
  <div class="row my-3">
    <div class="col-custom">
      <a href="{{ route('log.index') }}" class="btn btn-block btn-fill w-100 text-start">アクセス履歴照会</a>
    </div>
  </div>
</div>
<div class="items">
  <nav class="ps-0 navbar bg-secondary bg-loggedin bg-gradient bg-opacity-75 text-white">
    <div class="ps-0 container-fluid">
      <span class="navbar-brand text-dark">ユーザー管理</span>
    </div>
  </nav>
  <div class="row my-3">
    <div class="col-custom">
      <a href="{{ route('user.index') }}" class="btn btn-block btn-fill w-100 text-start">ユーザー設定</a>
    </div>
  </div>
</div>
