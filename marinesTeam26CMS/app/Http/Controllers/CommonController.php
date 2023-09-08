<?php
namespace App\Http\Controllers;
use App\Models\Movie;
use App\Models\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class CommonController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }
  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Movie  $movie
   * @return \Illuminate\Http\Response
   */
  public function show(Movie $movie)
  {
    //
  }
  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Movie  $movie
   * @return \Illuminate\Http\Response
   */
  public function edit(Movie $movie)
  {
    //
  }
  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Movie  $movie
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Movie $movie)
  {
    //
  }
  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Movie  $movie
   * @return \Illuminate\Http\Response
   */
  public function destroy(Movie $movie)
  {
    //
  }
  public function status_ajax(Request $request)
  {
    $datas = $request->all();
    $status = $datas['status'];
    $id = $datas['id'];
    $page = $datas['page'];
    if($page == 'top') {
      $bm = Banner::find($id);
      $bm->status = $status;
      $bm->save();
    }elseif($page == 'movie') {
      $bm = Movie::find($id);
      $bm->status = $status;
      $bm->save();
    }
    return response()->json(array('msg' => $bm), 200);
  }
}
