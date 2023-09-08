@extends('templates.apps',['class' => 'top-page-create'])
@section('content')
{{ old('title') }}
@php 
//dd($old_data);
@endphp
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
              <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control"
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
              <input style="width: 250px;" id="sort" name="sort" value="{{ old('sort') }}" type="text"
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
                <img id="preview-image-before-upload">
                <div class="input-group">
                  <label for="file" class="btn btn-sm btn-pink btn-outline-pink px-5 text-white rounded-2">新規登録</label>
                  <input style="visibility: hidden;" data-route="{{ route('content.uploadimage') }}" id="file" name="image" type="file" >
                  <input style=" visibility: hidden; " id="imageBefore" name="imageBefore" type="text" value="">
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
              <input placeholder="https://example.com" id="url" name="url" value="{{ old('url') }}" type="text"
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
                <option value="0" @if(old('select')==0) selected @endif>新規のウィンドウ</option>
                <option value="1" @if(old('select')==1) selected @endif>現在のウィンドウ</option>
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
                @foreach ($fantynameen as $key => $ftn)
                <div class="form-check form-check-inline" id="checks">
                  <input class="form-check-input" type="checkbox" @if( old('checks') && in_array($ftn->id,old('checks'))) checked @endif name="checks[]" id="inlineCheckboxb{{$key}}" value="{{ $ftn->id }}">
                  <label class="form-check-label" for="inlineCheckboxb{{$key}}">{{ $ftn->fantypename }}</label>
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
              <input id="time1" name="time1" style=" max-width: 250px; " class="datepicker form-select flatpickr-input"
                readonly="readonly" value="{{ old('time1') }}">
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
              <input id="time2" name="time2" style=" max-width: 250px; " class="datepicker2 form-select flatpickr-input"
                readonly="readonly" value="{{ old('time2') }}">
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
                <option value="1" @if(old('status')==1) selected @endif>公開
                </option>
                <option value="0" @if(old('status')==0) selected @endif>非公開
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
                <button type="reset" onclick="resetFormTopPage()" style=" width: 120px; " class="btn btn-dark text-white btn-outline-secondary px-3">クリア</button>
                <button style=" width: 120px; " onclick="document.getElementById('topManagement').submit()" type="button" class="btn btn-pink px-4">登録</button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
</div>
@endsection
@section("script")
<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.korzh.com/metroui/v4.5.1/js/metro.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">
  $(".datepicker").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i:S"
  });
  $(".datepicker2").flatpickr({
    enableTime: true,
    dateFormat: "Y-m-d H:i:S"
  });
  $(document).ready(function (e) {
     var checkUrlImg = '@php echo isset($old_data['imageBefore']) ? $old_data['imageBefore'] : '' @endphp'
     if(checkUrlImg != '')
     {
        $(".top-page-create #preview-image-before-upload").attr("src", checkUrlImg);
        $(".top-page-create #imageBefore").attr("value", checkUrlImg);
     }
    function uploadfileCreate(urlRoute) {
      var CSRF_TOKEN = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
      var formData = new FormData();
      var files = $(".top-page-create #file")[0].files;
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
            $(".top-page-create #preview-image-before-upload").attr("src", response.imghost);
            $(".top-page-create #imageBefore").attr("value", response.imghost);
          }
        },
        error: function (response) {
          if(response.responseJSON.errors.file[0].length) {
            alert('ファイルには2Mb以下をアップロードしてください。');
          }
        },
      });
    }

    $(".top-page-create #file").change(function () {
      var urlRoute = $(this).data('route');
      uploadfileCreate(urlRoute);
    });

    jQuery(function($){
      $("#duplicator").click(function(event){
        event.preventDefault();
        var new_area = $('#topManagement').serializeArray();
        $.redirect('@php echo url("top-page-management"); @endphp', {'_token': '@php echo csrf_token() @endphp', datas: new_area}, "GET", "_blank");
      });
    });
  });
  
</script>
@endsection
