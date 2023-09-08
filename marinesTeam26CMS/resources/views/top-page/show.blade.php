@extends('templates.apps',['class' => 'top-page-show'])
@section('content')
<div class="content">
  <div class="container-fluid">
    <nav class="ps-0 navbar bg-secondary bg-loggedin bg-gradient bg-opacity-75 text-white">
      <div class="ps-0 container-fluid container-fluid--after">
        <span class="navbar-brand text-dark"><span style=" font-weight: 700; ">トップページ管理</span> | @if(isset($type) && $type ==
          1) モーダルバナー設定 @elseif(isset($type) && $type == 2)
          TOPメインバナー設定 @elseif(isset($type) && $type == 3) グッズバナー設定 @elseif(isset($type) && $type == 4) コンテンツバナー設定
          @elseif(isset($type) && $type == 5) フッターバナー設定 @endif</span>
        <a id="duplicator" data-route="{{ route("top-page-type-copy-get", $type) }}" class="navbar-brand text-dark d-flex align-items-center text-decoration-underline"
          href="javascript:void(0)">
          <img style="width: 20px;margin-right: 5px;" src="{{ secure_asset('assets/icon/copy-solid.svg') }}"
            alt="Logo">コピーして作成
        </a>
      </div>
    </nav>
  </div>
  <div class="container-fluid container-manament">
    <form class="w-100" action="{{ route('top-page-type-edit-id-put',[$type,$id]) }}" method="POST" id="topManagementEdit"
      enctype="multipart/form-data">
      @method("PUT")
      @csrf
      <table id="example" class="table mt-5 text-center table-bordered" cellspacing="0" width="100%">
        <tbody>
          <tr>
            <td>
              <div style="font-weight: bold;    padding-left: 55px;">
                ID
              </div>
            </td>
            <td width="80%" class="text-start font-weight-bold">{{ $id }}</td>
          </tr>
          <tr>
            <td>
              <div>
                <span class="fieldrequire">必須</span>
              <span class="fieldlabel">管理名称</span>
              </div>
            </td>
            <td width="80%">
              <input type="text" name="title" id="title" value="{{ $banner['title'] }}" class="form-control"
                aria-describedby="passwordHelpInline">
              @if ($errors->has('title'))
              <div class="text-left"><span class="text-danger">{{ $errors->first('title') }}</span></div>
              @endif
            </td>
          </tr>
          <tr>
            <td>
              <div>
                <span class="fieldrequire">必須</span>
              <span class="fieldlabel">表示順</span>
              </div>
            </td>
            <td>
              <input style=" width: 250px; " id="sort" name="sort" value="{{ $banner['sort_no'] }}" type="text"
                class="form-control" aria-describedby="passwordHelpInline">
              @if ($errors->has('sort'))
              <div class="text-left"><span class="text-danger">{{ $errors->first('sort') }}</span></div>
              @endif
            </td>
          </tr>
          <tr>
            <td>
              <div>
                <span class="fieldrequire">必須</span>
                <span class="fieldlabel">画像</span>
              </div>
            </td>
            <td>
              <div class="d-flex align-items-center">
                <img id="preview-image-before-upload" src="{{ isset($old_data['imageBefore']) ? $old_data['imageBefore'] : $banner['image_url'] }}" alt="">                                                                                                                                          
                <input type="hidden" name="image_url" value={{ $banner['image_url'] }}>
                <div class="input-group">
                  <label for="file" class="btn btn-sm btn-pink btn-outline-pink px-5 text-white rounded-2">登録</label>
                  <input style=" visibility: hidden; " data-route="{{ route('content.uploadimage') }}" id="file" name="image" type="file">
                  <input style=" visibility: hidden; " id="imageAfter" name="imageAfter" type="text" value="{{ $banner['image_url'] }}">
                  <input style=" visibility: hidden; " id="imageBefore" name="imageBefore" type="text" value="{{ $banner['image_url'] }}">
                </div>
                @if ($errors->has('image'))
                <div class="text-left"><span class="text-danger">{{ $errors->first('image') }}</span></div>
                @endif
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div>
                <span class="fieldrequire">必須</span>
              <span class="fieldlabel">遷移先</span>
              </div>
            </td>
            <td width="80%">
              <input placeholder="https://example.com" value="{{ $banner['url'] }}" id="url" name="url" type="text"
                class="form-control" aria-describedby="passwordHelpInline">
              @if ($errors->has('url'))
              <div class="text-left"><span class="text-danger">{{ $errors->first('url') }}</span></div>
              @endif
            </td>
          </tr>
          <tr>
            <td>
              <div>
                <span class="fieldrequire">必須</span>
              <span class="fieldlabel">リンク設定</span>
              </div>
            </td>
            <td width="80%" class="text-start">
              <select class="form-select" aria-label="Default select example" id="select" name="select">
                <option value="0" {{ $banner['target']== '_blank' ? "selected" : "" }}>新規のウィンドウ</option>
                <option value="1" {{ $banner['target']=='_self' ? "selected" : "" }}>現在のウィンドウ</option>
              </select>
              @if ($errors->has('select'))
              <div class="text-left"><span class="text-danger">{{ $errors->first('select') }}</span></div>
              @endif
            </td>
          </tr>
          <tr>
            <td>
              <div>
                <span class="fieldrequire">必須</span>
              <span class="fieldlabel">会員種別</span>
              </div>
            </td>
            @php
            $arrfct = [];
            foreach ($banner->fantypenameen as $bf) :
            array_push($arrfct, $bf->id);
            endforeach;
            @endphp
            <td width="80%">
              <div class="text-start" id="checks">
                @foreach ($fantynameen as $key => $ftn)
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" @if(in_array($ftn->id,$arrfct)) checked @endif
                  name="checks[]" id="inlineCheckboxa{{$key}}" value="{{ $ftn->id }}">
                  <label class="form-check-label" for="inlineCheckboxa{{$key}}">{{ $ftn->fantypename }}</label>
                </div>
                @endforeach
                @if ($errors->has('checks'))
                <div class="text-left"><span class="text-danger">{{ $errors->first('checks') }}</span></div>
                @endif
              </div>
            </td>
          </tr>
          <tr>
            <td>
              <div>
                <span class="fieldrequire">必須</span>
              <span class="fieldlabel">開始日時</span>
              </div>
            </td>
            <td width="80%" class="text-start">
              <input id="time1" name="time1" style=" max-width: 250px; " readonly="readonly"
                value="{{ old('time1', $banner['publish_start']) }}" class="datepicker form-select flatpickr-input">
              @if ($errors->has('time1'))
              <div class="text-left"><span class="text-danger">{{ $errors->first('time1') }}</span></div>
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
              <input id="time2" name="time2" style=" max-width: 250px; " readonly="readonly"
                value="{{ old('time1', $banner['publish_end']) }}" class="datepicker2  form-select flatpickr-input">
              @if ($errors->has('time2'))
              <div class="text-left"><span class="text-danger">{{ $errors->first('time2') }}</span></div>
              @endif
            </td>
          </tr>
          <tr>
            <td>
              <div>
                <span class="fieldrequire">必須</span>
              <span class="fieldlabel">公開</span>
              </div>
            </td>
            <td width="80%" class="text-start">
              <select class="form-select" aria-label="Default select example" id="status" name="status">
                <option value="1" @if($banner['status']==1) selected @endif>公開</option>
                <option value="0" @if($banner['status']==0) selected @endif>非公開</option>
              </select>
              @if ($errors->has('status'))
              <div class="text-left"><span class="text-danger">{{ $errors->first('status') }}</span></div>
              @endif
            </td>
          </tr>
          <tr>
            <input type="hidden" name="id" value="{{ $id }}">
            <td colspan="2">
              @if($permission == 1)
              <div class="form-check form-check-block text-center my-3">
                <input class="form-check-input float-none" id="deleteinput" @if($banner['delete_at']) checked @endif
                  type="checkbox" name="checkper">
                <label for="deleteinput">削除する</label>
              </div>
              @endif
              <div class="form-check form-check-block text-center">
                <?php $arrURL = explode("/", $_SERVER['REQUEST_URI']);
                $type = explode("?",$arrURL[2]); ?>
                <a class="btn btn-dark text-white btn-outline-secondary" href="{{ route('top-page-type',$type[0]) }}">もどる</a>
                <button type="button"  style="width: 120px;" id="SubmitEdit" class="btn btn-pink px-4">登録</button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
</div>
@endsection
