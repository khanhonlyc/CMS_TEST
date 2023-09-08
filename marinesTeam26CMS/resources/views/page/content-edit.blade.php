@extends('templates.apps',['class' => 'page-content-edit'])
@section('title', '動画管理')
@section('content')
@php
$ftcs = $movie->fan_type_code;
$arrftc = explode(",",$ftcs);
@endphp
<div class="content">
  <div class="container-fluid">
    <nav class="ps-0 navbar bg-secondary bg-loggedin bg-gradient bg-opacity-75 text-white">
      <div class="ps-0 container-fluid container-fluid--after">
        <span class="navbar-brand text-dark"><span style=" font-weight: 700; ">動画管理</span> | コンテンツ登録・編集</span>
        <a id="duplicator" data-route="{{ route('content.copy', $movie->id) }}" class="navbar-brand text-dark d-flex align-items-center text-decoration-underline" href="#">
          <img style="width: 20px;margin-right: 5px;" src="{{ secure_asset('assets/icon/copy-solid.svg') }}" alt="Logo">コピーして作成
        </a>
      </div>
    </nav>
  </div>
  <div class="container-manament">
    <form class="w-100" action="{{ route('content.update', $movie->id) }}" method="POST" id="topManagementEdit" enctype="multipart/form-data">
      @method('PUT')
      @csrf
      <div class="container-fluid container-manament">
        <table id="example" class="table mt-5 text-center table-bordered border" cellspacing="0" width="100%" data-select2-id="example">
          <tbody>
            <tr>
              <td>
                <div>
                  <span class="fieldrequire">必須</span>
                  <span class="fieldlabel">タイトル</span>
                </div>
              </td>
              <td width="80%">
                <input type="text" name="title" class="form-control" value="{{ old('title', $movie->title) }}">
                <input type="hidden" name="movie_id" value="{{$movie->id}}">
                @if ($errors->has('title'))
                <div class=" text-left"><span class="text-danger">{{ $errors->first('title') }}</span></div>
                @endif
              </td>
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
                    <option value="2" {{ old('live', $movie->movie_type_code == 2) ? 'selected' : '' }}>LIVE</option>
                    <option value="1" {{ old('live', $movie->movie_type_code == 1) ? 'selected' : '' }}>VOD</option>
                  </select>
                  @if ($errors->has('live'))
                  <div class=" text-left"><span class="text-danger">{{ $errors->first('live') }}</span></div>
                  @endif
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
                  <img id="preview-image-before-upload" src="{{ $movie->thumbnail_url }}">
                  <div class="input-group">
                    <label for="file" class="btn btn-sm btn-pink btn-outline-pink px-5 text-white rounded-2">新規登録</label>
                    <input style=" visibility: hidden; " data-route="{{ route('content.uploadimage') }}" id="file" name="image" type="file">
                    <input style=" visibility: hidden; " id="imageAfter" name="imageAfter" type="text" value="{{ $movie->thumbnail_url }}">
                    <input style=" visibility: hidden; " id="imageBefore" name="imageBefore" type="text" value="">
                  </div>
                </div>
                @if ($errors->has('image'))
                <div class=" text-left"><span class="text-danger">{{ $errors->first('image') }}</span></div>
                @endif
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
                    <input type="checkbox" class="form-check-input" name="membership[]" value="{{ $ftn->id }}" {{ in_array($ftn->id, old('membership', $arrftc)) ? 'checked' : ''
                      }}>
                    <label class="form-check-label">{{ $ftn->fantypename }}</label>
                  </div>
                  @endforeach
                </div>
                @if ($errors->has('membership'))
                <div class=" text-left"><span class="text-danger">{{ $errors->first('membership') }}</span></div>
                @endif
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
                  <textarea style="height: 150px;" class="form-control" name="iframe" placeholder="Leave a comment here">{{ old('iframe', $movie->sauce) }}</textarea>
                </div>
                @if ($errors->has('iframe'))
                <div class=" text-left"><span class="text-danger">{{ $errors->first('iframe') }}</span></div>
                @endif
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
                {!! Form::select('tag[]', $tags, old('tags', $movie->tags->pluck('id')), ['class' => 'form-control select2',
                'multiple' => 'multiple','name'=>'tags[]','id' => 'selectall-tag' ]) !!}
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
                <input class="datepicker form-select flatpickr-input" style=" max-width: 250px; " name="datepicker" type="text" readonly="readonly" value="{{ old('datepicker', $movie->publish_start) }}">
                @if ($errors->has('datepicker'))
                <div class=" text-left"><span class="text-danger">{{ $errors->first('datepicker') }}</span></div>
                @endif
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
                <input class="datepicker2 form-select flatpickr-input" style=" max-width: 250px; " name="datepicker2" type="text" readonly="readonly" value="{{ old('datepicker2', $movie->publish_end) }}">
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
                  <option value="1" {{ old('status', $movie->status) == 1 ? 'selected' : '' }}>公開</option>
                  <option value="0" {{ old('status', $movie->status) == 0 ? 'selected' : '' }}>非公開</option>
                </select>
                @if ($errors->has('status'))
                <div class=" text-left"><span class="text-danger">{{ $errors->first('status') }}</span></div>
                @endif
              </td>
            </tr>
            <tr>
              <input type="hidden">
              <td colspan="2">
                @if( $permission == 1)
                <div class="form-check form-check-block text-center my-3">
                  <input class="form-check-input float-none" id="deleteinput" type="checkbox" name="checkper">
                  <label for="deleteinput">削除する</label>
                </div>
                @endif
                <div class="form-check form-check-block text-center">
                  <button style=" width: 120px; " type="button" class="btn btn-dark text-white btn-outline-secondary px-3" onclick="history.back()">戻る</button>
                  <a href="#" data-bs-toggle="modal" style=" width: 120px; " class="btn btn-outline-dark px-4" data-bs-target="#exampleModal{{ $movie->id }}" class="preview">プレビュー</a>
                  <button style=" width: 120px; " type="button" id="SubmitEdit" class="btn btn-outline-dark px-4 swatch-pink btn-outline-pink">登録</button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </form>
  </div>
  <!-- Modal Edit -->
  <div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalLabelEdit" aria-hidden="true">
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
                  <input class="form-check-input float-none permission" id="deleteinput" checked="" type="checkbox" value="option1">
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
  @endsection
