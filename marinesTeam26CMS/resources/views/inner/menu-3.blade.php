<li class="mypage parent">
  <a class="minimal d-flex justify-content-between">
    <p>マスタ管理</p>
    <i class="nc-icon nc-minimal-down mr-0"></i>
  </a>
  <ul class="sub-menu submenu">
    <li class="{{ (request()->is('fan-type')) ? 'active' : '' }}"><a class="p-0"
        href="{{route('fan-type.index')}}">サイト種別マスタ設定</a></li>
  </ul>
</li>
<li class="mypage parent">
  <a class="minimal d-flex justify-content-between">
    <p>ログ照会</p>
    <i class="nc-icon nc-minimal-down mr-0"></i>
  </a>
  <ul class="sub-menu submenu">
    <li class="{{ (request()->is('log')) ? 'active' : '' }}"><a class="p-0" href="{{route('log.index')}}">アクセス履歴照会</a>
    </li>
  </ul>
</li>
<li class="mypage parent">
  <a class="minimal d-flex justify-content-between">
    <p>ユーザー管理</p>
    <i class="nc-icon nc-minimal-down mr-0"></i>
  </a>
  <ul class="sub-menu submenu">
    <li class="{{ (request()->is('user')) ? 'active' : '' }}"><a class="p-0" href="{{route('user.index')}}">ユーザー設定</a>
    </li>
  </ul>
</li>
