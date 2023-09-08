<li class="mypage parent">
  <a class="minimal d-flex justify-content-between">
    <p>トップページ管理</p>
    <i class="nc-icon nc-minimal-down mr-0 {{ (request()->is('top-page*')) ? 'activeaction' : '' }}"></i>
  </a>
  <ul class="sub-menu submenu">
    <li class="{{ (request()->is('top-page/1')) ? 'active' : '' }}"><a class="p-0" href="{{ route('top-page-type',1) }}">モーダルバナー設定</a></li>
    <li class="{{ (request()->is('top-page/2')) ? 'active' : '' }}"><a class="p-0" href="{{ route('top-page-type',2) }}">TOPメインバナー設定</a></li>
    <li class="{{ (request()->is('top-page/3')) ? 'active' : '' }}"><a class="p-0"href="{{ route('top-page-type',3) }}">グッズバナー設定</a></li>
    <li class="{{ (request()->is('top-page/4')) ? 'active' : '' }}"><a class="p-0" href="{{ route('top-page-type',4) }}">コンテンツバナー設定</a></li>
    <li class="{{ (request()->is('top-page/5')) ? 'active' : '' }}"><a class="p-0" href="{{ route('top-page-type',5) }}">フッターバナー設定</a></li>
  </ul>
</li>
