@extends('templates.apps',['class' => 'page-log-history'])
@section('title', 'ログ照会')
@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="{{ secure_asset('css/metro-all.min.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="content">
  <main class="main py-4">
    <div class="container-fluid">
      <nav class="ps-0 navbar bg-secondary bg-loggedin bg-gradient bg-opacity-75 text-white">
        <div class="ps-0 container-fluid">
          <span class="navbar-brand text-dark"><span style=" font-weight: 700; ">ログ照会</span> | アクセス履歴照会</span>
        </div>
      </nav>
    </div>
    <div class="container-fluid container-top">
      <div class="form">
        <form action="{{ route('log.index') }}" method="get" id="formone">
          <table>
            <tbody>
              <tr>
                <td>検索</td>
              </tr>
              <tr>
                <td>マリーンズID</td>
                <td>
                  <input style=" width: 200px; " class="form-control" type="text" value="@if(array_key_exists('keyword', $datas)) {{ $datas['keyword'] }} @endif" id="keyword" name="keyword">
                </td>
              </tr>
              <tr>
                <td>アクセス日時</td>
                <td class="d-flex align-items-center">
                  <input style=" width: 200px; " class="datepicker form-control" name="datepicker" value="@if(array_key_exists('datepicker', $datas)) {{ $datas['datepicker'] }} @endif"> ~ <input style=" width: 200px; " name="datepicker2" class="datepicker2 form-control"  value="@if(array_key_exists('datepicker2', $datas)) {{ $datas['datepicker2'] }} @endif">
                </td>
              </tr>
            </tbody>
          </table>
            <select name="sortBy" id="" hidden>
              <option value="id">ID</option>
            </select>
            <select name="sortType" id="" hidden>
              <option value="asc" @if(isset($datas['sortType']) && $datas['sortType'] == 'asc') selected @endif>昇順</option>
              <option value="desc" @if(isset($datas['sortType']) && $datas['sortType'] == 'desc') selected @endif>降順</option>
            </select>
          <div class="button bg-transparent">
            <a class="btn btn-dark text-white btn-outline-secondary" href="{{ route('log.index') }}">クリア</a>
            <button class="btn btn-pink" type="submit">検索</button>
          </div>
        </form>
      </div>
      <div class="team-content">
        <p>表示順</p>
        <form action="{{ route('log.index') }}" method="get" id="three">
          <div class="dropdown">
            <select name="sortBy" id="">
              <option value="id">ID</option>
            </select>
            <select name="sortType" id="">
              <option value="asc" @if(isset($datas['sortType']) && $datas['sortType'] == 'asc') selected @endif>昇順</option>
              <option value="desc" @if(isset($datas['sortType']) && $datas['sortType'] == 'desc') selected @endif>降順</option>
            </select>
            <input  type="text" value="@if(array_key_exists('keyword', $datas)) {{ $datas['keyword'] }} @endif" name="keyword" hidden>
            <input class="datepicker" name="datepicker" value="@if(array_key_exists('datepicker', $datas)) {{ $datas['datepicker'] }} @endif" hidden>
            <input name="datepicker2" class="datepicker2"  value="@if(array_key_exists('datepicker2', $datas)) {{ $datas['datepicker2'] }} @endif" hidden>
            <button class="btn btn-black" type="submit" id="formtwo" data-route="log-query">ソート</button>
          </div>
        </form>
        <table id="tableresult">
          <thead>
            <tr>
              <th>ID</th>
              <th style=" width: 150px; ">マリーンズID</th>
              <th>アクセス日時</th>
              <th style=" max-width: 450px; ">リクエストURL</th>
              <th style=" width: 150px; ">リファラー</th>
              <th>アクセスIP</th>
              <th>アクセスIP</th>
            </tr>
          </thead>
          <div class="note" id="note">{{ $logs->firstItem() }}〜{{ $logs->lastItem() }}/{{ $logs->total() }}件</div>
          <tbody id="table_data">
            @foreach ($logs as $key => $log )
            <tr>
              <td>{{ $log->id }}</td>
              <td>{{ $log->marines_id }}</td>
              <td>
                {{ $log->regist_dt }}
              </td>
              <td style=" max-width: 450px; word-break: break-word;">
                {{ $log->request_url }}
              </td>
              <td>
                {{ $log->referer }}
              </td>
              <td>
                {{ $log->access_ip }}
              </td>
              <td>
                {{ $log->user_agent }}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $logs->appends($_GET)->links('vendor.pagination.custom') }}
      </div>
    </div>
  </main>
</div>
@endsection
