<li class="mypage parent">
  <a class="minimal d-flex justify-content-between">
    <p>動画管理</p>
    <i class="nc-icon nc-minimal-down mr-0"></i>
  </a>
  <ul class="sub-menu submenu">
    <li class="{{ (request()->is('content')) ? 'active' : '' }}"><a class="p-0" href="{{ route('content.index') }}">コンテンツ一覧</a></li>
    <li class="{{ (request()->is('content/create')) ? 'active' : '' }}"><a class="p-0" href="{{ route('content.create') }}">コンテンツ登録</a></li>
    <li class="{{ (request()->is('tag')) ? 'active' : '' }}"><a class="p-0" href="{{ route('tag.index') }}">タグ設定</a></li>
  </ul>
</li>
