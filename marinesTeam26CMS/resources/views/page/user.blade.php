@extends('templates.apps',['class' => 'page-user'])
@section('title', 'ユーザー管理')
@section('content')
<div class="content">
  <main class="main py-4">
    <div class="container-fluid">
      <nav class="ps-0 navbar bg-secondary bg-loggedin bg-gradient bg-opacity-75 text-white">
        <div class="ps-0 container-fluid">
          <span class="navbar-brand text-dark"><span style=" font-weight: 700; ">ユーザー管理</span> | ユーザー設定</span>
        </div>
      </nav>
    </div>
    <div class="container-fluid container-top">
      <div class="button bg-transparent">
        <button class="btn btn-pink" data-bs-toggle="modal" data-bs-target="#exampleModal" type="submit">新規登録</button>
      </div>
      <div class="team-content">
        <p>表示順</p>
        <form action="{{ route('user.index') }}">
          <div class="dropdown">
            <select name="createUpdateAt">
              <option value="id" @if(!empty($allrequest) && array_key_exists("createUpdateAt",$allrequest) && $allrequest['createUpdateAt'] == 'id') selected @endif>ID</option>
              <option value="created_at" @if(!empty($allrequest) && array_key_exists("createUpdateAt",$allrequest) && $allrequest['createUpdateAt'] == 'created_at') selected @endif>登録日時</option>
              <option value="updated_at" @if(!empty($allrequest) && array_key_exists("createUpdateAt",$allrequest) && $allrequest['createUpdateAt'] == 'updated_at') selected @endif>更新日時</option>
            </select>
            <select name="descAsc">
              <option value="asc"  @if(!empty($allrequest) && array_key_exists("descAsc",$allrequest) && $allrequest['descAsc'] == 'asc') selected @endif>昇順</option>
              <option value="desc"  @if(!empty($allrequest) && array_key_exists("descAsc",$allrequest) && $allrequest['descAsc'] == 'desc') selected @endif>降順</option>
            </select>
            <button class="btn btn-black" type="submit">ソート</button>
          </div>
        </form>
        <div class="note" id="note">{{ $users->firstItem() }}〜{{ $users->lastItem() }}/{{ $users->total() }}件</div>
        <table id="tableresult">
          <thead>
            <tr>
              <th>ID</th>
              <th width="150">権限</th>
              <th>ID/メールアドレス</th>
              <th>名前</th>
              <th>登録日時<br />更新日時</th>
              <th>編集</th>
            </tr>
          </thead>
          <tbody id="table_data">
            @foreach ($users as $user)
            <tr>
              <td>{{ $user->id }}</td>
              <td>
                {{$user->permissionname ? $user->permissionname->permission_name : ''}}
              </td>
              <td>
                {{ $user->user_id }}
              </td>
              <td>
                {{ $user->user_name }}
              </td>
              <td>
                {{ $user->created_at }} <br />
                {{ $user->updated_at }}
              </td>
              <td>
                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalEdit{{ $user->id }}">編集</a>
              </td>
            </tr>
            <div class="modal fade" id="exampleModalEdit{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content pt-5">
                  <div class="modal-header border-0 py-1">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">ユーザー設定</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body p-0">
                    <form action="{{ route('user.update', $user->id) }}" method="POST">
                      @method('PUT')
                      @csrf
                      <div class="container">
                        <div class="row justify-content-center">
                          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="mb-0">
                              <div class="row g-3 align-items-center mb-3">
                                <div class="col-auto" style=" width: 180px; ">
                                  <label for="inputPasswordp" class="col-form-label">権限</label>
                                </div>
                                <div class="col-auto" style=" width: calc(100% - 180px); ">
                                  <select class="form-select" name="authority">
                                    @foreach ($authorities as $authority)
                                      <option value="{{ $authority->permission_id }}" @if($user->permissionname->permission_id == $authority->permission_id) selected @endif>{{ $authority->permission_name }}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                              <div class="row g-3 align-items-center mb-3">
                                <div class="col-auto" style=" width: 180px; ">
                                  <label for="inputPassworda{{ $user->id }}" class="col-form-label">ID/メールアドレス</label>
                                </div>
                                <div class="col-auto" style=" width: calc(100% - 180px); ">
                                  <input type="text" name="id" value="{{ $user->user_id }}" id="inputPassworda{{ $user->id }}" class="form-control" aria-describedby="passwordHelpInline">
                                </div>
                              </div>
                              <div class="row g-3 align-items-center mb-3">
                                <div class="col-auto" style=" width: 180px; ">
                                  <label for="inputPasswordb{{ $user->id }}" class="col-form-label">名前</label>
                                </div>
                                <div class="col-auto" style=" width: calc(100% - 180px); ">
                                  <input type="text" value="{{ $user->user_name }}" id="inputPasswordb{{ $user->id }}" name="name" class="form-control"
                                    aria-describedby="passwordHelpInline">
                                </div>
                              </div>
                              <div class="row g-3 align-items-center mb-3">
                                <div class="col-auto" style=" width: 180px; ">
                                  <label for="inputPasswordc{{ $user->id }}" class="col-form-label">パスワード</label>
                                </div>
                                <div class="col-auto" style=" width: calc(100% - 180px); ">
                                  <input type="text" id="inputPasswordc{{ $user->id }}" name="password" class="form-control"
                                    aria-describedby="passwordHelpInline">
                                </div>
                              </div>
                            </div>
                            @if($permission == 1)
                              <div class="form-check form-check-block text-center my-3">
                                <input class="form-check-input float-none" id="deleteinput" @if($user->deleted_at == 1) checked @endif type="checkbox" name="checkper">
                                <label for="deleteinput">削除する</label>
                              </div>
                            @endif
                            <div class="form-check form-check-block text-center my-3">
                              <button type="submit" class="btn btn-sm swatch-pink btn-outline-pink px-5">登録</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </tbody>
          @if($users->hasPages())
          <tfoot>
            <tr>
              <td colspan="6" class="paginationcenter">
                {!! $users->appends($_GET)->links() !!}
              </td>
            </tr>
          </tfoot>
          @endif
        </table>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content pt-5">
          <div class="modal-header border-0 py-1">
            <h1 class="modal-title fs-5" id="exampleModalLabel">ユーザー設定</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-0">
            <form action="{{ route('user.store') }}" method="POST">
              @csrf
              <div class="container">
                <div class="row justify-content-center">
                  <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                    <div class="mb-0">
                      <div class="row g-3 align-items-center mb-3">
                        <div class="col-auto" style=" width: 180px; ">
                          <label for="inputPasswordp" class="col-form-label">権限</label>
                        </div>
                        <div class="col-auto" style=" width: calc(100% - 180px); ">
                          <select class="form-select" name="authority">
                            @foreach ($authorities as $authority)
                            <option value="{{ $authority->permission_id }}">{{ $authority->permission_name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="row g-3 align-items-center mb-3">
                        <div class="col-auto" style=" width: 180px; ">
                          <label for="inputPassworda" class="col-form-label">ID/メールアドレス</label>
                        </div>
                        <div class="col-auto" style=" width: calc(100% - 180px); ">
                          <input type="text" name="id" id="inputPassworda" class="form-control"
                            aria-describedby="passwordHelpInline">
                        </div>
                      </div>
                      <div class="row g-3 align-items-center mb-3">
                        <div class="col-auto" style=" width: 180px; ">
                          <label for="inputPasswordb" class="col-form-label">名前</label>
                        </div>
                        <div class="col-auto" style=" width: calc(100% - 180px); ">
                          <input type="text" id="inputPasswordb" name="name" class="form-control"
                            aria-describedby="passwordHelpInline">
                        </div>
                      </div>
                      <div class="row g-3 align-items-center mb-3">
                        <div class="col-auto" style=" width: 180px; ">
                          <label for="inputPasswordc" class="col-form-label">パスワード</label>
                        </div>
                        <div class="col-auto" style=" width: calc(100% - 180px); ">
                          <input type="text" id="inputPasswordc" name="password" class="form-control"
                            aria-describedby="passwordHelpInline">
                        </div>
                      </div>
                    </div>
                    <div class="form-check form-check-block text-center my-3">
                      <button type="submit" class="btn btn-sm swatch-pink btn-outline-pink px-5">登録</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
@endsection
