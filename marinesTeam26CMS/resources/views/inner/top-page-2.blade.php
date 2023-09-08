<div class="items">
  <nav class="ps-0 navbar bg-secondary bg-loggedin bg-gradient bg-opacity-75 text-white">
    <div class="ps-0 container-fluid">
      <span class="navbar-brand text-dark">動画管理</span>
    </div>
  </nav>
  <div class="row my-3">
    <div class="col-custom">
      <a href="{{ route('content.index') }}" class="btn btn-block btn-fill w-100 text-start">コンテンツ一覧</a>
    </div>
    <div class="col-custom">
      <a href="{{ route('content.create') }}" class="btn btn-block btn-fill w-100 text-start">コンテンツ登録</a>
    </div>
    <div class="col-custom">
      <a href="{{ route('tag.index') }}" class="btn btn-block btn-fill w-100 text-start">タグ設定</a>
    </div>
  </div>
</div>
