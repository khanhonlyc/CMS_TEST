@extends('templates.apps',['class' => 'top-page-index'])
@section('content')
<div class="content">
  <div class="container-fluid">
    <nav class="ps-0 navbar bg-secondary bg-loggedin bg-gradient bg-opacity-75 text-white">
      <div class="ps-0 container-fluid">
        <span class="navbar-brand text-dark"><span style=" font-weight: 700; ">トップページ管理</span> | @if(isset($id) && $id ==
          1) モーダルバナー設定 @elseif(isset($id) && $id == 2)
          TOPメインバナー設定 @elseif(isset($id) && $id == 3) グッズバナー設定 @elseif(isset($id) && $id == 4) コンテンツバナー設定
          @elseif(isset($id) && $id == 5) フッターバナー設定 @endif</span>
      </div>
    </nav>
  </div>
  <div class="container-fluid container-top">
    <div class="form">
      <form action="{{ route('top-page-type',[$id]) }}" method="GET">
        <table>
          <tbody>
            <tr>
              <td>検索</td>
            </tr>
            <tr>
              <td>名称</td>
              <td>
                <input type="text text-start" class="form-control" value="@if(array_key_exists('keyword', $datas)) {{ $datas['keyword'] }} @endif" id="keyword" name="keyword" style=" width: 200px; ">
              </td>
            </tr>
            <tr>
              <td>会員種別</td>
              <td>
                <div class="list">
                  @foreach ($fantynameen as $ftnen)
                  <label>
                    <input type="checkbox" name="membership[]" @if(array_key_exists("membership", $datas) &&
                      in_array($ftnen->id,$datas['membership'])) checked @endif value="{{ $ftnen->id }}">
                    <span>{{ $ftnen->fantypename }}</span>
                  </label>
                  @endforeach
                </div>
              </td>
            </tr>
            <tr>
              <td>状態</td>
              <td>
                <div class="list">
                  <label>
                    <input type="checkbox" value="1" @if(array_key_exists("status", $datas) && in_array(1,
                      $datas['status'])) checked @endif name="status[]">
                    <span>公開</span>
                  </label>
                  <label>
                    <input type="checkbox" value="0" @if(array_key_exists("status", $datas) && in_array(0,
                      $datas['status'])) checked @endif name="status[]">
                    <span>非公開</span>
                  </label>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="button bg-transparent">
          <?php $arrURL = explode("/", $_SERVER['REQUEST_URI']);
          $type = explode("?",$arrURL[2]); ?>
          <a class="btn btn-dark text-white btn-outline-secondary" href="{{ route('top-page-type',$type[0]) }}">クリア</a>
          <button class="btn btn-pink" type="submit">検索</button>
        </div>
      </form>
    </div>
    <div class="button button-register bg-transparent">
      <a class="btn btn-dark text-white btn-outline-secondary" href="{{ route('top-page-type-create-get',$id) }}">新規登録</a>
    </div>
    <div class="team-content">
      <form action="{{ route('top-page-type',[$id]) }}" method="GET">
        <input type="hidden" value="@if(array_key_exists('keyword', $datas)) {{ $datas['keyword'] }} @endif"
          id="keyword" name="keyword">
        @foreach ($fantynameen as $ftn)
        <input style="display: none" type="checkbox" name="membership[]" @if(array_key_exists("membership", $datas) &&
          in_array($ftn->id, $datas['membership'])) checked @endif value="{{ $ftn->id }}">
        @endforeach
        <input style="display: none" type="checkbox" value="1" @if(array_key_exists("status", $datas) && in_array(1,
          $datas['status'])) checked @endif name="status[]">
        <input style="display: none" type="checkbox" value="0" @if(array_key_exists("status", $datas) && in_array(0,
          $datas['status'])) checked @endif name="status[]">
        <div class="dropdown">
          <select name="createUpdateAt">
            <option value="sort_no" @if(in_array("sort_no", $datas)) selected @endif>表示順</option>
            <option value="publish_start" @if(in_array("publish_start", $datas)) selected @endif>公開日時</option>
            <option value="created_at" @if(in_array("create_at", $datas)) selected @endif>登録日時</option>
            <option value="updated_at" @if(in_array("update_at", $datas)) selected @endif>更新日時</option>
          </select>
          <select name="descAsc">
            <option value="asc" @if(in_array("asc", $datas)) selected @endif>昇順</option>
            <option value="desc" @if(in_array("desc", $datas)) selected @endif>降順</option>
          </select>
          <button class="btn btn-black" type="submit" data-route="top-page" name="submitv" value="submitv">ソート</button>
        </div>
      </form>
      <div class="note" id="note">{{ $banners->firstItem() }}〜{{ $banners->lastItem() }}/{{ $banners->total() }}件</div>
      <table id="tableresult">
        <thead>
          <tr>
            <th>ID</th>
            <th>表示順</th>
            <th colspan="2">登録内容</th>
          </tr>
        </thead>
        <tbody id="table_data">
          @include("data")
        </tbody>
      </table>
      {!! $banners->withQueryString()->links() !!}
    </div>
  </div>
</div>
@endsection
