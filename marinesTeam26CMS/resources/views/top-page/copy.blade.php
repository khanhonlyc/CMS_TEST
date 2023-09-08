@extends('templates.apps',['class' => 'top-page-copy'])
@php
$arrfct = [];
foreach ($getData['datas'] as $item) :
  if($item['name'] == 'checks[]') array_push($arrfct,$item['value'] );
  if($item['name'] == 'time1') $time1 = $item['value'];
  if($item['name'] == 'time2') $time2 = $item['value'];
  if($item['name'] == 'status') $status = $item['value'];
  if($item['name'] == 'title') $title = $item['value'];
  if($item['name'] == 'sort') $sort = $item['value'];
  if($item['name'] == 'url') $url = $item['value'];
  if($item['name'] == 'select') $select = $item['value'];
  if($item['name'] == 'imageBefore') $imageBefore = $item['value'];
endforeach;
@endphp
@section('content')
<div class="content">
  <div class="container-fluid">
    <nav class="ps-0 navbar bg-secondary bg-loggedin bg-gradient bg-opacity-75 text-white">
      <div class="ps-0 container-fluid container-fluid--after">
        <span class="navbar-brand text-dark"><span style=" font-weight: 700; ">トップページ管理</span> | @if(isset($type) && $type ==
          1) モーダルバナー設定 @elseif(isset($type) && $type == 2)
          TOPメインバナー設定 @elseif(isset($type) && $type == 3) グッズバナー設定 @elseif(isset($type) && $type == 4) コンテンツバナー設定
          @elseif(isset($type) && $type == 5) フッターバナー設定 @endif</span>
      </div>
    </nav>
  </div>
  <div class="container-fluid container-manament">
    <form action="{{ route('top-page-type-create-post',$type) }}" method="POST" id="topManagement"
      enctype="multipart/form-data" class="w-100">
      @csrf
      <div class="w-100">
      <table id="example" class="table mt-5 text-center table-bordered" cellspacing="0" width="100%">
        <tbody>
          <tr>
            <td>
              <div>
              <span class="fieldrequire">必須</span>
              <span class="fieldlabel">管理名称</span>
            </div>
            </td>
            <td width="80%">
              <input type="hidden" name="id" value="{{ $type }}">
              <input type="text" name="title"
                value="{{ isset($title) ? $title : '' }}"
                class="form-control" aria-describedby="passwordHelpInline">
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
              <input style="width: 250px;" name="sort" value="{{ (isset($sort) ? $sort : '') }}" type="text" class="form-control" aria-describedby="passwordHelpInline">
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
                <img id="preview-image-before-upload" class="active" src="{{ isset($imageBefore) ? $imageBefore : '' }}">
                <input type="hidden" name="image_url" value="">
                <div class="input-group">
                  <label for="file" class="btn btn-sm btn-pink btn-outline-pink px-5 text-white rounded-2">新規登録</label>
                  <input style="visibility: hidden;" data-route="{{ route('content.uploadimage') }}" id="file" name="image" type="file" >
                  <input style=" visibility: hidden; " id="imageAfter" name="imageAfter" type="text" value="{{ isset($getData['datas'][4]['value']) ? $getData['datas'][4]['value'] : '' }}">
                  <input style=" visibility: hidden; " id="imageBefore" name="imageBefore" type="text" value="{{ isset($imageBefore) ? $imageBefore : '' }}">
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
              <input placeholder="https://example.com" name="url"
                value="{{ isset($url) ? $url : '' }}" type="text"
                class="form-control" aria-describedby="passwordHelpInline">
            </td>
            @if ($errors->has('url'))
            <div class="text-left"><span class="text-danger">{{ $errors->first('url') }}</span></div>
            @endif
          </tr>
          <tr>
            <td>
              <div>
              <span class="fieldrequire">必須</span>
              <span class="fieldlabel">リンク設定</span>
              </div>
            </td>
            <td width="80%" class="text-start">
              <select class="form-select" aria-label="Default select example" name="select">
                <option value="0" {{ (isset($select) && $select == 0) ? 'selected' : '' }}>新規のウィンドウ</option>
                <option value="1" {{ (isset($select) && $select == 1) ? 'selected' : '' }}>現在のウィンドウ</option>
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
            <td width="80%">
              <div class="text-start">
                @foreach ($fantynameen as $key => $ftnen)
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" name="checks[]" @if(in_array($ftnen->id,$arrfct))
                  checked @endif name="checks[]" id="inlineCheckboxc{{$key}}" value="{{$ftnen->id}}">
                  <label class="form-check-label" for="inlineCheckboxc{{$key}}">{{ $ftnen->fantypename }}</label>
                </div>
                @endforeach
              </div>
              @if ($errors->has('checks'))
              <div class="text-left"><span class="text-danger">{{ $errors->first('checks') }}</span></div>
              @endif
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
              <input name="time1" readonly="readonly" style=" max-width: 250px; "
                class="datepicker form-select flatpickr-input" value="{{ isset($time1) ? $time1 : '' }}">
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
              <input name="time2" readonly="readonly" style=" max-width: 250px; "
                class="datepicker2 form-select flatpickr-input" value="{{ isset($time2) ? $time2 : '' }}">
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
              <select class="form-select" aria-label="Default select example" name="status">
                <option value="1"{{ isset($status) && $status == 1 ? 'selected' : '' }}>公開
                </option>
                <option value="0" {{ isset($status) && $status == 0 ? 'selected' : '' }}>非公開
                </option>
              </select>
              @if ($errors->has('status'))
              <div class="text-left"><span class="text-danger">{{ $errors->first('status') }}</span></div>
              @endif
            </td>
          </tr>
          <tr>
            <input type="hidden">
            <td colspan="2">
              <div class="form-check form-check-block text-center">
                <button style=" width: 120px; " type="reset" onclick="resetFormTopPageCopy()" class="btn btn-dark text-white btn-outline-secondary px-3">クリア</button>
                <button style=" width: 120px; " onclick="document.getElementById('topManagement').submit()" type="button" class="btn btn-pink px-4">登録</button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    </form>
  </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script type="text/javascript">
  function resetFormTopPageCopy() {
    $('input[name="title"]').removeAttr("value");
    $('input[name="sort"]').removeAttr("value");
    $("#file").removeAttr("value");
    $("#preview-image-before-upload").removeAttr("src");
    $("#preview-image-before-upload").removeClass("active");
    $('input[name="url"]').removeAttr("value");
    $(".form-select option").removeAttr("selected");
    $(".datepicker").removeAttr("value");
    $(".datepicker2").removeAttr("value");
    $('.form-check-input').removeAttr("checked");
  }
  $(document).ready(function (e) {
    function uploadfileCopy(urlRoute) {
      console.log(urlRoute);
      var CSRF_TOKEN = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
      var formData = new FormData();
      var files = $("#file")[0].files;
      formData.append("file", files[0]);
      formData.append("_token", CSRF_TOKEN);
      $.ajax({
        type: "POST",
        url: urlRoute,
        data: formData,
        contentType: false,
        processData: false,
        success: (response) => {
          if (response.imgName) {
            $("#preview-image-before-upload").attr("src", response.imghost);
            $("#imageBefore").attr("value", response.imghost);
          }
        },
        error: function (response) {
          if(response.responseJSON.errors.file[0].length) {
            alert('ファイルには2Mb以下をアップロードしてください。');
          }
        },
      });
    }
    $("#file").change(function () {
      var urlRoute = $(this).data('route');
      uploadfileCopy(urlRoute);
    });
  });
</script>