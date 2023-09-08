@extends('templates.apps',['class' => 'page-tag'])
@section('title', '動画管理')
@section('content')
<div class="content">
  <main class="main py-4">
    <div class="container-fluid">
      <nav class="ps-0 navbar bg-secondary bg-loggedin bg-gradient bg-opacity-75 text-white">
        <div class="ps-0 container-fluid">
          <span class="navbar-brand text-dark"><span style=" font-weight: 700; ">動画管理</span> | タグ設定</span>
        </div>
      </nav>
    </div>
    <div class="container-fluid container-top">
      <div class="button bg-transparent">
        <button class="btn btn-pink" data-bs-toggle="modal" data-bs-target="#exampleModal" type="submit">タグ作成</button>
      </div>
      <div class="team-content">
        <p>表示順</p>
        <form action="{{ route('tag.index') }}" method="GET">
          <div class="dropdown">
            <select  name="createUpdateAt">
              <option value="id" @if(in_array("id", $allrequest)) selected @endif>ID</option>
              <option value="tag_id" @if(in_array("tag_id", $allrequest)) selected @endif>タグID</option>
              <option value="tag_name" @if(in_array("tag_name", $allrequest)) selected @endif>タグ名</option>
              <option value="created_at" @if(in_array("created_at", $allrequest)) selected @endif>登録日時</option>
            </select>
            <select name="descAsc">
              <option value="asc" @if(in_array("asc", $allrequest)) selected @endif>昇順</option>
              <option value="desc" @if(in_array("desc", $allrequest)) selected @endif>降順</option>
            </select>
            <button class="btn btn-black" type="submit">ソート</button>
          </div>
        </form>
        <div class="note" id="note">{{ $datas->firstItem() }}〜{{ $datas->lastItem() }}/{{ $datas->total() }}件</div>
        <table>
          <tbody>
            <tr>
              <th style=" width: 60px; ">ID</th>
              <th style=" width: 60px; ">タグID</th>
              <th style=" width: 300px">タグ名</th>
              <th style=" width: 180px; ">登録日時</th>
              <th style=" width: 70px; ">編集</th>
            </tr>
            @foreach ($datas as $key => $data)
              <tr>
                <td>{{$key+ $datas->firstItem()}}</td>
                <td>{{ $data->tag_id }}</td>
                <td>{{ $data->tag_name }}</td>
                <td>
                  {{$data->created_at}}
                </td>
                <td>
                  <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#exampleModalEdit{{ $data->id }}">編集</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        @foreach ($datas as $key2 => $data2)
        <div class="modal fade" id="exampleModalEdit{{ $data2->id }}" tabindex="-1" aria-labelledby="exampleModalLabelEdit" aria-hidden="true">
          <form>
            @method('put')
            <div class="modal-dialog">
              <div class="modal-content pt-5">
                <div class="alert alert-danger print-error-msg{{ $data2->id }}" style="display:none">
                  <ul></ul>
                </div>
                <div class="modal-header border-0 py-1">
                  <h1 class="modal-title fs-5" id="exampleModalLabelEdit">タグ登録</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="container">
                      <div class="mb-0 col-xs-11 col-sm-11 col-md-11 col-lg-11">
                        <div class="row g-3 align-items-center mb-3">
                          <div class="col-auto p-0" style=" width: 160px; ">
                            <label for="inputPassword1{{$key2}}" class="col-form-label">タグID</label>
                          </div>
                          <div class="col-auto" style=" width: calc(100% - 160px); ">
                            <input type="text" value="{{ $data2->tag_id }}" name="tag_id" id="inputPassword1{{$key2}}" class="form-control addTagID1" aria-describedby="passwordHelpInline">
                          </div>
                          <span class="errorTagID1" style="color:red;display:none;margin-top:0;">タグIDを入力してください。</span>
                        </div>
                        <div class="row g-3 align-items-center mb-3">
                          <div class="col-auto p-0" style=" width: 160px; ">
                            <label for="inputPassword2{{$key2}}" class="col-form-label">表示タグ名称</label>
                          </div>
                          <div class="col-auto" style=" width: calc(100% - 160px); ">
                            <input type="text"  value="{{ $data2->tag_name }}"  name="tag_name" id="inputPassword2{{$key2}}" class="form-control addTagName1" aria-describedby="passwordHelpInline">
                          </div>
                          <span class="errorTagName1" style="color:red;display:none;margin-top:0;">表示タグ名称を入力してください。</span>
                        </div>
                      </div>
                      @if($permission == 1)
                        <div class="form-check form-check-block text-center my-3">
                          <input class="form-check-input float-none" id="deleteinput" @if($data2->deleted_at) checked @endif type="checkbox" name="checkper">
                          <label for="deleteinput">削除する</label>
                        </div>
                      @endif
                      <div class="form-check form-check-block text-center mb-4">
                        <button class="btn btn-sm swatch-pink btn-outline-pink px-5 btn-submit-put" data-url="{{ route('tag.update',$data2->id) }}" data-id="{{$data2->id}}" data-tagid="{{$data2->tag_id}}" data-tagname="{{$data2->tag_name}}">登録</button>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        @endforeach
        {!! $datas->appends($_GET)->links('vendor.pagination.custom') !!}
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <form>
        <div class="modal-dialog">
          <div class="modal-content pt-5">
            <div class="alert alert-danger print-error-msg" style="display:none">
              <ul></ul>
            </div>
            <div class="modal-header border-0 pt-3 pb-2">
              <h1 class="modal-title fs-5" id="exampleModalLabel">タグ登録</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
              <div class="container">
                <div class="mb-0 col-xs-11 col-sm-11 col-md-11 col-lg-11">
                    <div class="row g-3 align-items-center mb-3">
                      <div class="col-auto p-0" style=" width: 160px; ">
                        <label for="inputPassword6" class="col-form-label">タグID</label>
                      </div>
                      <div class="col-auto" style=" width: calc(100% - 160px); ">
                        <input type="text" name="tag_id" id="inputPassword6" class="form-control addTagID2" aria-describedby="passwordHelpInline">
                      </div>
                      <span class="errorTagID2" style="color:red;display:none;margin-top:0;">タグIDを入力してください。</span>
                    </div>
                    <div class="row g-3 align-items-center mb-3">
                      <div class="col-auto p-0" style=" width: 160px; ">
                        <label for="inputPassword7" class="col-form-label">表示タグ名称</label>
                      </div>
                      <div class="col-auto" style=" width: calc(100% - 160px); ">
                        <input type="text" name="tag_name" id="inputPassword7" class="form-control addTagName2" aria-describedby="passwordHelpInline">
                      </div>
                      <span class="errorTagName2" style="color:red;display:none;margin-top:0;">表示タグ名称を入力してください。</span>
                    </div>
                </div>
                <div class="form-check form-check-block text-center my-3">
                  <button class="btn btn-sm swatch-pink btn-outline-pink px-5 btn-submit" data-route="{{ route('tag.store') }}">登録</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </main>
</div>
@endsection
