<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;
use DB;
class GraphicController extends Controller
{
  //
  public function index(){
    if(!session('logged_in')){
      return redirect('/');
    }
    $positif = Tweet::where('sentiment','positif')->get();
    $data['jml_positif'] = $positif->count();
    $negatif = Tweet::where('sentiment','negatif')->get();
    $data['jml_negatif'] = $negatif->count();
    $netral = Tweet::where('sentiment','netral')->get();
    $data['jml_netral'] = $netral->count();
    $data['title'] = "Graphic Pie Chart";

    $data['judul_grafik'] = 'All Sentiment Graphic';
    $keywords = Tweet::selectRaw('keyword')->groupBy('keyword')->get();
    $data['keyword_opt'][''] = '';
    foreach($keywords as $key => $value){
      $data["keyword_opt"][$value->keyword] = $value->keyword;
    }
    $data['chart'] = "container";
    //untuk opt class
    $data['class_opt'] = [''=>'','username'=>'Username','sentiment'=>'Sentiment'];
    return view('graphic.index',$data);
  }

  public function detail(Request $request){
    if(!session('logged_in')){
      return redirect('/');
    }
    if($request->class){
      if($request->class == "username"){
        $data['chart'] = "bar";
        $username = Tweet::selectRaw('username,count(username) as jml_username');
        if($request->keyword){
          $username = $username->where('keyword',$request->keyword);
        }
        $username = $username->groupBy('username')->limit(10)
        ->orderBy('jml_username','desc');
        $data['username'] = $username->get();

        $data['title'] = "Graphic Pie Chart";
        $data['jml_positif'] = 0;
        $data['jml_negatif'] = 0;
        $data['jml_netral'] = 0;
        $data['judul_grafik'] = "Tweets Count by User with $request->keyword keyword";
      }else if($request->class == "sentiment"){
        $data['chart'] = "container";
        $tweet = new Tweet;
        $positif = Tweet::where('sentiment','positif');
        $data['jml_positif'] = $positif->count();
        $negatif = Tweet::where('sentiment','negatif');
        $data['jml_negatif'] = $negatif->count();
        $netral = Tweet::where('sentiment','netral');
        $data['jml_netral'] = $netral->count();
        if($request->keyword){
          $positif = $positif->where('keyword',$request->keyword);
          $negatif = $negatif->where('keyword',$request->keyword);
          $netral = $netral->where('keyword',$request->keyword);
          $data['jml_positif'] = $positif->count();
          $data['jml_negatif'] = $negatif->count();
          $data['jml_netral'] = $netral->count();
        }
        $positif = $positif->get();
        $negatif = $negatif->get();
        $netral = $netral->get();
        $data['title'] = "Graphic Pie Chart";
        $data['judul_grafik'] = "Sentiment Graphic with $request->keyword keyword";
      }
    }else{
      $data['chart'] = "container";
      $tweet = new Tweet;
      $positif = Tweet::where('sentiment','positif');
      $data['jml_positif'] = $positif->count();
      $negatif = Tweet::where('sentiment','negatif');
      $data['jml_negatif'] = $negatif->count();
      $netral = Tweet::where('sentiment','netral');
      $data['jml_netral'] = $netral->count();
      if($request->keyword){
        $positif = $positif->where('keyword',$request->keyword);
        $negatif = $negatif->where('keyword',$request->keyword);
        $netral = $netral->where('keyword',$request->keyword);
        $data['jml_positif'] = $positif->count();
        $data['jml_negatif'] = $negatif->count();
        $data['jml_netral'] = $netral->count();
      }
      $positif = $positif->get();
      $negatif = $negatif->get();
      $netral = $netral->get();
      $data['title'] = "Graphic Pie Chart";
      $data['judul_grafik'] = "Sentiment Graphic with $request->keyword keyword";
    }

    // $data['judul_grafik'] = "Grafik $request->keyword";
    $keywords = Tweet::selectRaw('keyword')->groupBy('keyword')->get();
    $data['keyword_opt'][''] = '';
    //untuk opt class
    $data['class_opt'] = [''=>'','username'=>'Username','sentiment'=>'Sentiment'];
    foreach($keywords as $key => $value){
      $data["keyword_opt"][$value->keyword] = $value->keyword;
    }
    return view('graphic.index',$data);

  }
}
