@extends('templates.apps',['class' => 'page-fan-type'])
@section('title', 'マスタ管理')
@section('content')
<div class="content">
  <main class="main py-4">
    <div class="container-fluid">
      <nav class="ps-0 navbar bg-secondary bg-loggedin bg-gradient bg-opacity-75 text-white">
        <div class="ps-0 container-fluid">
          <span class="navbar-brand text-dark"><span style=" font-weight: 700; ">マスタ管理</span> | サイト種別マスタ設定</span>
        </div>
      </nav>
    </div>
    <div class="container-fluid container-top" style="margin-bottom: 350px">
      <div class="button bg-transparent">
        <button class="btn btn-pink" data-bs-toggle="modal" data-bs-target="#exampleModal" type="submit">新規作成</button>
      </div>
      <div class="team-content">
        <p>表示順</p>
        <form action="{{ route('fan-type.index') }}" method="GET">
          <div class="dropdown">
            <select name="createUpdateAt">
              <option value="id">ID</option>
              <option value="created_at"  @if(isset($allrequest) && in_array("created_at", $allrequest)) selected @endif>登録日時</option>
              <option value="updated_at"  @if(isset($allrequest) && in_array("updated_at", $allrequest)) selected @endif>更新日時</option>
            </select>
            <select name="descAsc">
              <option value="asc" @if(isset($allrequest) && in_array("asc", $allrequest)) selected @endif>昇順</option>
              <option value="desc" @if(isset($allrequest) && in_array("desc", $allrequest)) selected @endif>降順</option>
            </select>
            <button class="btn btn-black" type="submit">ソート</button>
          </div>
        </form>
        <div class="note" id="note">{{ $ranks->firstItem() }}〜{{ $ranks->lastItem() }}/{{ $ranks->total() }}件</div>
        <table>
          <tbody>
            <tr>
              <th>ID</th>
              <th style=" width: 160px; ">サイト種別コード</th>
              <th colspan="2">サイト種別</th>
              <th>編集</th>
            </tr>
            @foreach ($ranks as $rank)
            <tr>
              <td>{{ $rank->id }}</td>
              <td>
                @php
                $pr_id = (int)$rank->fantypecode;
                @endphp
                {{ sprintf("%02d", $pr_id)}}
              </td>
              <td>
                {{ $rank->fantypename }}
              </td>
              <td>
                {{ $rank->fantypenameen }}
              </td>
              <td>
                {{ $rank->created_at }} <br />
                {{ $rank->updated_at }}
              </td>
              <td>
                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalEdit{{ $rank->id  }}">編集</a>
              </td>
            </tr>
                <form action="{{ route('fan-type.update', $rank->id) }}" method="POST">
                  @method("PUT")
                  @csrf
                  <div class="modal fade" id="exampleModalEdit{{ $rank->id  }}" tabindex="-1"
                    aria-labelledby="exampleModalLabelEdit" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content pt-5">
                        <div class="modal-header border-0 py-1">
                          <h1 class="modal-title fs-5" id="exampleModalLabelEdit">サイト種別</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                          <div class="container">
                            <div class="mb-0">
                              <div class="row g-3 align-items-center mb-3">
                                <div class="col-auto" style=" width: 190px; ">
                                  <label for="inputPassworda{{ $rank->id  }}" class="col-form-label">サイト種別コード</label>
                                </div>
                                <div class="col-auto" style=" width: calc(100% - 190px); ">
                                  <input type="text" name="fantypecode" value={{ $rank->fantypecode  }} id="inputPassworda{{ $rank->id  }}" class="form-control" aria-describedby="passwordHelpInline" value="phoenix_league">
                                </div>
                              </div>
                              <div class="row g-3 align-items-center mb-3">
                                <div class="col-auto" style=" width: 190px; ">
                                  <label for="inputPasswordb{{ $rank->id  }}" class="col-form-label">サイト種別名</label>
                                </div>
                                <div class="col-auto" style=" width: calc(100% - 190px); ">
                                  <input type="text"  name="fantypename" value="{{ $rank->fantypename  }}" id="inputPasswordb{{ $rank->id  }}" class="form-control"
                                    aria-describedby="passwordHelpInline">
                                </div>
                              </div>
                              <div class="row g-3 align-items-center mb-3">
                                <div class="col-auto" style=" width: 190px; ">
                                  <label for="inputPasswordc{{ $rank->id  }}" class="col-form-label">サイト種別名（英字）</label>
                                </div>
                                <div class="col-auto" style=" width: calc(100% - 190px); ">
                                  <input type="text"  name="fantypenameen" value="{{ $rank->fantypenameen  }}" id="inputPasswordc{{ $rank->id  }}" class="form-control"
                                    aria-describedby="passwordHelpInline">
                                </div>
                              </div>
                            </div>
                            @if($permission == 1)
                              <div class="form-check form-check-block text-center my-3">
                                <input class="form-check-input float-none" id="deleteinput" @if($rank->deleted_at) checked @endif type="checkbox" name="checkper">
                                <label for="deleteinput">削除する</label>
                              </div>
                            @endif
                            <div class="form-check form-check-block text-center mb-4">
                              <button class="btn btn-sm swatch-pink btn-outline-pink px-5" type="submit">登録</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
            @endforeach
            @if($ranks->hasPages())
            <tr>
              <td colspan="6" class="link-center">
                {{ $ranks->appends($_GET)->links() }}
              </td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
    <!-- Modal -->
    <form action="{{ route('fan-type.store') }}" method="POST">
      @csrf
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content pt-5">
            <div class="modal-header border-0 py-1">
              <h1 class="modal-title fs-5" id="exampleModalLabel">サイト種別</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
              <div class="container">
                <div class="mb-0">
                  <div class="row g-3 align-items-center mb-3">
                    <div class="col-auto" style=" width: 190px; ">
                      <label for="inputPassword1" class="col-form-label">サイト種別コード</label>
                    </div>
                    <div class="col-auto" style=" width: calc(100% - 190px); ">
                      <input type="text" name="fantypecode" id="inputPassword1" class="form-control"
                        aria-describedby="passwordHelpInline">
                    </div>
                  </div>
                  <div class="row g-3 align-items-center mb-3">
                    <div class="col-auto" style=" width: 190px; ">
                      <label for="inputPassword2" class="col-form-label">サイト種別名</label>
                    </div>
                    <div class="col-auto" style=" width: calc(100% - 190px); ">
                      <input type="text" name="fantypename" id="inputPassword2" class="form-control"
                        aria-describedby="passwordHelpInline">
                    </div>
                  </div>
                  <div class="row g-3 align-items-center mb-3">
                    <div class="col-auto" style=" width: 190px; ">
                      <label for="inputPassword3" class="col-form-label">サイト種別名（英字）</label>
                    </div>
                    <div class="col-auto" style=" width: calc(100% - 190px); ">
                      <input type="text" name="fantypenameen" id="inputPassword3" class="form-control"
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
        </div>
      </div>
    </form>
  </main>
</div>
@endsection
