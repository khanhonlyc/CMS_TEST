@extends('templates.apps',['class' => 'page-content-registration'])
@section('title', '動画管理')
@section('content')
<div class="content">
  <main class="main py-4">
    <div class="container-fluid">
      <nav class="ps-0 navbar bg-secondary bg-loggedin bg-gradient bg-opacity-75 text-white">
        <div class="ps-0 container-fluid">
          <span class="navbar-brand text-dark"><span style=" font-weight: 700; ">動画管理</span> | コンテンツ登録・編集</span>
        </div>
      </nav>
    </div>
    <form action="{{ route('content.store') }}" method="POST" id="topManagement" enctype="multipart/form-data">
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
              <td width="80%">
                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
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
                    <option value="2" {{ old('live')==2 ? 'selected' : '' }}>LIVE</option>
                    <option value="1" {{ old('live')==1 ? 'selected' : '' }}>VOD</option>
                  </select>
                </div>
                @if ($errors->has('live'))
                <div class=" text-left"><span class="text-danger">{{ $errors->first('live') }}</span></div>
                @endif
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
                  <img id="preview-image-before-upload">
                  <div class="input-group">
                    <label for="file" class="btn btn-sm btn-pink btn-outline-pink px-5 text-white rounded-2">新規登録</label>
                    <input style=" visibility: hidden; " id="file" name="image" type="file">
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
                    <input type="checkbox" class="form-check-input" name="membership[]" value="{{ $ftn->id }}" {{ in_array($ftn->id,
                    old('membership') ?? []) ? 'checked' : '' }}>
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
                  <textarea style="height: 150px;" class="form-control" name="iframe"
                    placeholder="Leave a comment here">{{old('iframe')}}</textarea>
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
                {!! Form::select('tag[]', $tags, old('tags'), ['class' => 'form-control select2', 'multiple' => 'multiple','name'=>'tags[]','id' => 'selectall-tag' ]) !!}
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
                  value="{{ old('datepicker') }}">
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
                <input class="datepicker2 form-select" style=" max-width: 250px; " name="datepicker2"
                  value="{{ old('datepicker2') }}">
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
                  <option value="1" {{ old('status')==1 ? 'selected' : '' }}>公開</option>
                  <option value="0" {{ old('status')==0 ? 'selected' : '' }}>非公開</option>
                </select>
                @if ($errors->has('status'))
                <div class=" text-left"><span class="text-danger">{{ $errors->first('status') }}</span></div>
                @endif
              </td>
            </tr>
            <tr>
              <input type="hidden">
              <td colspan="2">
                <div class="form-check-block text-center">
                  <button style=" width: 120px; " type="button" class="btn btn-dark text-white btn-outline-secondary px-3" onclick="history.back()">戻る</button>
                  <a href="#" data-bs-toggle="modal" style=" width: 120px; " class="btn btn-dark text-white btn-outline-secondary px-4 preview" data-bs-target="#exampleModal">プレビュー</a>
                  <button onclick="document.getElementById('topManagement').submit()" style=" width: 120px; " type="button" class="btn btn-outline-dark px-4 swatch-pink btn-outline-pink">登録</button>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">プレビュー</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <img class="d-block w-100 mb-2" id="preview_img" src="" alt="">
            <time class="d-block" datetime=""></time>
            <p class="preview_title"></p>
            <div class="preview_tag"></div>
          </div>
          <div class="modal-body">
            <div class="movie">
            </div>
          </div>
        </div>
      </div>
    </main>
</div>
@endsection
