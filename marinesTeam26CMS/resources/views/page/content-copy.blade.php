@extends('templates.apps',['class' => 'page-content-copy'])
@section('title', '動画管理')
@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="{{ secure_asset('css/metro-all.min.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
@php
    $membership = $oldtags = [];
    foreach ($getData['datas'] as $item) :
    if($item['name'] == 'membership[]') array_push($membership,$item['value'] );
    if($item['name'] == 'tags[]') array_push($oldtags,$item['value'] );
    if($item['name'] == 'iframe') $iframe = $item['value'];
    if($item['name'] == 'datepicker') $datepicker = $item['value'];
    if($item['name'] == 'datepicker2') $datepicker2 = array_key_exists("value",$item) ? $item['value']: null;
    if($item['name'] == 'status') $status = $item['value'];
    if($item['name'] == 'live') $live = $item['value'];
    endforeach;
@endphp
@section('content')
<div class="content">
  <main class="main py-4">
    <div class="container-fluid container-manament mt-5">
      @if (Session::has('success'))
      <div class="alert alert-success alert-dismissible" role="alert">
        <i class="fa-solid fa-check fa-fw text-success"></i>
        <strong>Success !</strong> {{ session('success') }}
      </div>
      @endif
      @if (Session::has('error'))
      <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert">
          <i class="fa fa-times"></i>
        </button>
        <strong>Error !</strong> {{ session('error') }}
      </div>
      @endif
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
    </div>
    <div class="container-fluid">
      <nav class="ps-0 navbar bg-secondary bg-loggedin bg-gradient bg-opacity-75 text-white">
        <div class="ps-0 container-fluid">
          <span class="navbar-brand text-dark"><span style=" font-weight: 700; ">動画管理</span> | コンテンツ登録・編集</span>
        </div>
      </nav>
    </div>
    <form action="{{ route('content.store') }}" method="POST" id="topManagementDup" enctype="multipart/form-data">
      @csrf
      <div class="container-fluid container-manament">
        <table id="example" class="table mt-5 text-center table-bordered border" cellspacing="0" width="100%">
          <tbody>
            <tr>
              <td>
                <div>
                <span class="fieldrequire">必須</span>
                <span class="fieldlabel">タイトル</span>
              </div>
              </td>
              <td width="80%"><input type="text" name="title" class="form-control"
                  value="@if(isset($getData['datas'][2]['value'])) {{$getData['datas'][2]['value']}} @endif"></td>
            </tr>
            <tr>
              <td>
                <div>
                <span class="fieldrequire">必須</span>
                <span class="fieldlabel">動画区分</span>
                </div>
              </td>
              <td style=" width: 80px; ">
                <div class="dropdown text-start">
                  <select name="live" class="py-2 form-select" style=" max-width: 250px; ">
                    <!-- <option value="2" @if(isset($getData['datas'][4]['value']) && $getData['datas'][4]['value']==2) selected @endif>LIVE</option> -->
                    <option value="2" >LIVE</option>
                    <option value="1" @if(isset($live) && $live==1) selected @endif>VOD</option>
                  </select>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div>
                <span class="fieldrequire">必須</span>
                <span class="fieldlabel">サムネイル画像</span>
                </div>
              </td>
              <td class="text-start">
                <div class="d-flex align-items-center">
                  <img id="preview-image-before-upload" class="active" src="@if(isset($getData['datas'][5]['value'])) {{ $getData['datas'][5]['value'] }} @else {{ $getData['datas'][4]['value'] }} @endif">
                  <div class="input-group">
                    <label for="file" class="btn btn-sm btn-pink btn-outline-pink px-5 text-white rounded-2">新規登録</label>
                    <input style=" visibility: hidden; " id="file" name="image" type="file">
                    <input style=" visibility: hidden; " id="imageAfter" name="imageAfter" type="text" value="{{ $getData['datas'][4]['value'] }}">
                    <input style=" visibility: hidden; " id="imageBefore" name="imageBefore" type="text" value="">
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div>
                <span class="fieldrequire">必須</span>
                <span class="fieldlabel">公開会員種別</span>
                </div>
              </td>
              <td width="80%" class="text-start">
                <div class="list">
                  @foreach ($fantynameen as $key => $ftn)
                  <div class="form-check form-check-inline">
                    <input type="checkbox" class="form-check-input" name="membership[]" @if(in_array($ftn->id,$membership)) checked @endif
                    value="{{ $ftn->id }}">
                    <label class="form-check-label">{{ $ftn->fantypename }}</label>
                  </div>
                  @endforeach
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div>
                <span class="fieldrequire">必須</span>
                <span class="fieldlabel">動画ソース</span>
                </div>
              </td>
              <td width="80%">
                <div class="form-floating">
                  <textarea style="height: 150px;" class="form-control" name="iframe"
                    placeholder="Leave a comment here">{{ $iframe }}</textarea>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div>
                <span class="fieldrequire">必須</span>
                <span class="fieldlabel">タグ・キーワード</span>
                </div>
              </td>
              <td class="text-start">
                {!! Form::select('tag[]', $tags, $oldtags, ['class' => 'form-control select2', 'multiple' =>
                'multiple','name'=>'tags[]','id' => 'selectall-tag' ]) !!}
              </td>
            </tr>
            <tr>
              <td>
                <div>
                <span class="fieldrequire">必須</span>
                <span class="fieldlabel">公開日時</span>
                </div>
              </td>
              <td width="80%" class="text-start">
                <input class="datepicker form-select" style=" max-width: 250px; " name="datepicker"
                  value="{{ $datepicker }}">
              </td>
            </tr>
            <tr>
              <td>
                <div>
                <span class="fieldrequire">必須</span>
                <span class="fieldlabel">終了日時</span>
                </div>
              </td>
              <td width="80%" class="text-start">
                <input class="datepicker2 form-select" style=" max-width: 250px; " name="datepicker2"
                  value="{{ $datepicker2 }}">
              </td>
            </tr>
            <tr>
              <td>
                <div>
                <span class="fieldrequire">必須</span>
                <span class="fieldlabel">非公開</span>
                </div>
              </td>
              <td class="text-start select-status">
                <select class="form-select" aria-label="Default select example" name="status">
                  <option value="1" @if($status==1) selected @endif>公開</option>
                  <option value="0" @if($status==0) selected @endif>非公開</option>
                </select>
              </td>
            </tr>
            <tr>
              <input type="hidden">
              <td colspan="2">
                <div class="form-check form-check-block text-center">
                  <button style=" width: 120px; " type="button" class="btn btn-dark text-white btn-outline-secondary  px-3" onclick="window.close();">戻る</button>
                  <a href="#" data-bs-toggle="modal" style=" width: 120px; " class="btn btn-outline-dark px-4" data-bs-target="#exampleModal{{ $movie->id }}" class="preview">プレビュー</a>
                  <button style=" width: 120px; " type="button" id="SubmitEdit" class="btn btn-pink px-4 swatch-pink btn-outline-pink">登録</button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </form>
    <!-- Modal Edit -->
    <div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalLabelEdit"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header border-0 py-1">
            <h1 class="modal-title fs-5" id="exampleModalLabelEdit">アップロード</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-0">
            <div class="container">
              <div class="mb-0">
                <div class="form-check form-check-block text-center my-3">
                  <div class="label-active border">
                    <input class="form-check-input float-none permission" id="deleteinput" checked="" type="checkbox"
                      value="option1">
                    <label for="deleteinput" class="active">ファイルを選択</label>
                    <label for="deleteinput" class="notactive">選択されていません</label>
                  </div>
                </div>
                <div class="form-check form-check-block text-center mb-4">
                  <a href="#" class="btn btn-sm swatch-pink btn-outline-pink px-5 btn-pink text-white">登録</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="exampleModal{{ $movie->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">プレビュー</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <img class="d-block w-100 mb-2" src={{ $movie->thumbnail_url }} alt="">
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
  </main>
</div>
@endsection
