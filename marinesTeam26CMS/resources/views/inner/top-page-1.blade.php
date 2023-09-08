<div class="items">
  <nav class="ps-0 navbar bg-secondary bg-loggedin bg-gradient bg-opacity-75 text-white">
    <div class="ps-0 container-fluid">
      <span class="navbar-brand text-dark">トップページ管理</span>
    </div>
  </nav>
  <div class="row my-3">
    <div class="col-custom">
      <a href="{{ route('top-page-type',1) }}" class="btn btn-block btn-fill w-100 text-start">モーダルバナー設定</a>
    </div>
    <div class="col-custom">
      <a href="{{ route('top-page-type',2) }}" class="btn btn-block btn-fill w-100 text-start">TOPメインバナー設定</a>
    </div>
    <div class="col-custom">
      <a href="{{ route('top-page-type',3) }}" class="btn btn-block btn-fill w-100 text-start">グッズバナー設定</a>
    </div>
    <div class="col-custom">
      <a href="{{ route('top-page-type',4) }}" class="btn btn-block btn-fill w-100 text-start">コンテンツバナー設定</a>
    </div>
    <div class="col-custom">
      <a href="{{ route('top-page-type',5) }}" class="btn btn-block btn-fill w-100 text-start">フッターバナー設定</a>
    </div>
  </div>
</div>
