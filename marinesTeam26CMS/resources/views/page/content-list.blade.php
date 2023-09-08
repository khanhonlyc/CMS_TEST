@extends('templates.apps',['class' => 'page-content-list'])
@section('title', '動画管理')
@section('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="content">
  <main class="main py-4">
    <div class="container-fluid">
      <nav class="ps-0 navbar bg-secondary bg-loggedin bg-gradient bg-opacity-75 text-white">
        <div class="ps-0 container-fluid">
          <span class="navbar-brand text-dark"><span style=" font-weight: 700; ">動画管理</span> | コンテンツ 一覧</span>
        </div>
      </nav>
    </div>
    @php
    $oldtags = $status = [];
    $videoCategories = null;
    foreach ($datas as $key => $item) :
    if($key == 'tag') $oldtags = $item;
    if($key == 'videoCategories') $videoCategories = $item;
    if($key == 'status') $status = $item;
    endforeach;
    @endphp
    <div class="container-fluid container-top">
      <div class="form">
        <form action="{{ route('content.index') }}" method="get" id="formone">
          <table>
            <tbody>
              <tr>
                <td>絞込み</td>
              </tr>
              <tr>
                <td colspan="2">
                  <div class="container">
                    <div class="row">
                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 d-flex align-items-center">
                        <span style=" width: 80px; ">タイトル</span>
                        <input class="form-control" type="text" value="@if(array_key_exists("keyword", $datas)){{$datas['keyword']}}@endif" id="keyword" name="keyword">
                      </div>
                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 d-flex align-items-center">
                        <span style=" width: 80px; ">タグ</span>
                        {!! Form::select('tag[]', $tags, $oldtags, ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-tag' ]) !!}
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td style=" width: 80px; ">
                  動画区分
                </td>
                <td>
                  <div class="dropdown">
                    <select name="videoCategories" class="py-2" style=" width: 120px; ">
                      <option value="">全て</option>
                      <option value="1" @if(isset($datas['videoCategories']) && $datas['videoCategories'] == 1) selected @endif>VOD</option>
                      <option value="2" @if(isset($datas['videoCategories']) && $datas['videoCategories'] == 2) selected @endif>LIVE</option>
                    </select>
                  </div>
                </td>
              </tr>
              <tr>
                <td>公開</td>
                <td>
                  <div class="list">
                    <label>
                      <input type="checkbox" value="1"  @if(in_array(1, $status)) checked @endif   name="status[]">
                      <span>公開</span>
                    </label>
                    <label>
                      <input type="checkbox" value="0"  @if(in_array(0, $status)) checked @endif   name="status[]">
                      <span>非公開</span>
                    </label>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
            <select name="sortBy" hidden>
              <option value="sort_no" @if(isset($request['sortBy']) && $request['sortBy'] == 'sort_no') selected @endif>表示順</option>
              <option value="publish_start" @if(isset($request['sortBy']) && $request['sortBy'] == 'publish_start') selected @endif>公開日</option>
              <option value="created_at" @if(isset($request['sortBy']) && $request['sortBy'] == 'created_at') selected @endif>登録日時</option>
              <option value="updated_at" @if(isset($request['sortBy']) && $request['sortBy'] == 'updated_at') selected @endif>更新日時</option>
            </select>
            <select name="sortType" id="" hidden>
              <option value="asc" @if(isset($request['sortType']) && $request['sortType'] == 'asc') selected @endif>昇順</option>
              <option value="desc" @if(isset($request['sortType']) && $request['sortType'] == 'desc') selected @endif>降順</option>
            </select>
          <div class="button bg-transparent">
            <a class="btn btn-dark text-white btn-outline-secondary"  href="{{ route('content.index') }}">クリア</a>
            <button class="btn btn-black" type="submit">検索</button>
          </div>
        </form>
      </div>
      <div class="button bg-transparent">
        <a class="btn btn-pink text-white" type="button" href="{{ route('content.create') }}">新規登録</a>
      </div>
      <div class="team-content">
        <th>表示順</th>
        <form action="{{ route('content.index') }}" method="get" id="">
          <input class="form-control" type="text" value="@if(array_key_exists("keyword", $datas)){{$datas['keyword']}}@endif" hidden name="keyword">
          <div style="display:none;">{!! Form::select('tag[]', $tags, old('tag'), ['class' => 'form-control select2', 'multiple' => 'multiple', ]) !!}</div>
          <select name="videoCategories" class="py-2" hidden>
            <option value="">全て</option>
            <option value="1" @if(isset($datas['videoCategories']) && $datas['videoCategories'] == 1) selected @endif>VOD</option>
            <option value="2" @if(isset($datas['videoCategories']) && $datas['videoCategories'] == 2) selected @endif>LIVE</option>
          </select>
          <input type="checkbox" value="1"  @if(array_key_exists("status", $datas) && in_array(1, $datas['status'])) checked @endif   name="status[]" hidden>
          <input type="checkbox" value="0"  @if(array_key_exists("status", $datas) && in_array(0, $datas['status'])) checked @endif   name="status[]" hidden>
          <div class="dropdown">
            <select name="sortBy" id="">
              <option value="sort_no" @if(isset($request['sortBy']) && $request['sortBy'] == 'sort_no') selected @endif>表示順</option>
              <option value="publish_start" @if(isset($request['sortBy']) && $request['sortBy'] == 'publish_start') selected @endif>公開日</option>
              <option value="created_at" @if(isset($request['sortBy']) && $request['sortBy'] == 'created_at') selected @endif>登録日時</option>
              <option value="updated_at" @if(isset($request['sortBy']) && $request['sortBy'] == 'updated_at') selected @endif>更新日時</option>
            </select>
            <select name="sortType" id="">
              <option value="asc" @if(isset($request['sortType']) && $request['sortType'] == 'asc') selected @endif>昇順</option>
              <option value="desc" @if(isset($request['sortType']) && $request['sortType'] == 'desc') selected @endif>降順</option>
            </select>
            <button class="btn btn-black" type="submit" id="formtwo" data-route="video-management">ソート</button>
          </div>
        </form>
        <div class="note" id="note">{{ $movies->firstItem() }}〜{{ $movies->lastItem() }}/{{ $movies->total() }}件</div>
        <table  id="tableresult">
          <thead>
            <tr>
              <th>ID</th>
              <th style=" width: 80px; ">表示順</th>
              <th colspan="2">登録内容</th>
              <th width="60px">確認</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($movies as $key => $movie )
              <tr class="@if($movie->status == 1) active @endif">
                <td class="@if($movie->status == 0) bg-gray @endif">{{ $movie->id }}</td>
                <td class="@if($movie->status == 0) bg-gray @endif">{{ $movie->sort_no }}</td>
                <td class="@if($movie->status == 0) bg-gray @endif">
                  <div class="icon">
                    <img src={{ $movie->thumbnail_url }} alt="">
                  </div>
                </td>
                <td class="@if($movie->status == 0) bg-gray @endif">
                  <div class="text">
                    <span class="date">{{ $movie->publish_start }}　～　{{ $movie->publish_end }}</span>
                    <h3>@if($movie->movie_type_code == 2) <span style=" background-color: #d9534f; color: #fff; font-size: 15px; text-transform: uppercase; margin-right: 5px; display: inline-block; padding: 0 10px; ">LIVE</span>@else <span style=" background-color: #4c3f3e; color: #fff; font-size: 15px; text-transform: uppercase; margin-right: 5px; display: inline-block; padding: 0 10px; ">VOD</span> @endif<a href="{{ route('content.show', $movie->id) }}">{{ $movie->title }}</a></h3>
                    @php
                      $ftcs = $movie->fan_type_code;
                      $arrftc = explode(",",$ftcs);
                    @endphp
                    <div class="tags">
                      @foreach ($fantynameen as $key => $ftn)
                        @if(in_array($ftn->id,$arrftc))
                          <a href="javascript:void(0)">{{ $ftn->fantypename }}</a>
                        @endif
                      @endforeach
                    </div>
                    <div class="time">
                      <div class="time-custom">
                        <span>登録日時</span>
                        <p class="m-0">{{ $movie->created_at }}</p>
                      </div>
                      <div class="time-custom">
                        <span>更新日時</span>
                        <p class="m-0">{{ $movie->updated_at }}</p>
                      </div>
                    </div>
                  </div>
                </td>
                <td class="@if($movie->status == 0) bg-gray @endif">
                  <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $movie->id }}" class="preview"><img style=" width: 20px; " <img style=" width: 20px; " src="{{ secure_asset('assets\icon\magnifying-glass-solid.svg') }}" alt="magnifying"></a>
                </td>
              </tr>
              <div class="modal fade" id="exampleModal{{ $movie->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">プレビュー</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <h3 class="mb-0 bg-loggedin text-center"><a href="#" class="text-dark text-decoration-none h5">一覧</a></h3>
                    <img class="d-block w-100 mb-2"  src={{ $movie->thumbnail_url }} alt="">
                    <time class="d-block" datetime="2022/10/20">{{\Carbon\Carbon::parse($movie->publish_start)->format('Y/m/d')}}</time>
                    <p>{{ $movie->title }}</p>
                    @foreach($movie->tags as $tag )
                      <a href="#" data-id={{ $tag->tag_id }} class="btn btn-outline-white border rounded-4 px-4">{{ $tag->tag_name }}</a>
                    @endforeach
                  </div>
                  @if($movie->sauce)
                    <div class="modal-body">
                      <div class="movie">
                        {!!$movie->sauce!!}
                      </div>
                    </div>
                  @endif
                </div>
              </div>
            </div>
            @endforeach
          </tbody>
        </table>
        <nav aria-label="Page navigation example" class="mt-4">
          {{-- {{echo $_GET}} --}}
          {{-- {{ $request->input('page') }} --}}
          {{-- {{ $movies->appends($_GET) }} --}}
          {{ $movies->appends($_GET)->links('vendor.pagination.custom') }}
        </nav>
      </div>
    </div>
  </main>
</div>
@endsection
