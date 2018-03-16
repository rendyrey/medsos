<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;

class DashboardController extends Controller
{
    //
    public function __construct(){

    }
    public function index(){
      if(!session('logged_in')){
        return redirect('/');
      }
      return view('dashboard.index');
    }
    
    public function twitter_scrape(){
      if(!session('logged_in')){
        return redirect('/');
      }
      return view('dashboard.twitter_scrape');
    }

    public function instagram_scrape(){
      if(!session('logged_in')){
        return redirect('/');
      }
      return view('dashboard.instagram_scrape');
    }

    public function facebook_scrape(){
      if(!session('logged_in')){
        return redirect('/');
      }
      return view('dashboard.instagram_scrape');
    }

    public function twitter_data(Request $request,$offset){
      if(!session('logged_in')){
        return redirect('/');
      }
      //memisahkan tanggal
      $date_range = $request->date_range;
      $start_date = substr($date_range,0,10);
      $end_date = substr($date_range,-10);
      $sentiment = $request->sentiment;
      $keyword = $request->keyword;

      $data['kosong'] = FALSE;
      if($request->submit){
        //mengambil tweet berdasarkan inputan
        $tweet = new Tweet;
        $tweet = $tweet->where('date','>=',$start_date);
        $tweet = $tweet->where('date','<=',$end_date);
        if($sentiment)
        $tweet = $tweet->where('sentiment',$sentiment);
        if($keyword)
        $tweet = $tweet->where('keyword',$keyword);
        $tweet = $tweet->limit(500);
        $tweet = $tweet->get();
        $data['tweet'] = $tweet;
        if($data['tweet']->count() == 0){
          $data['kosong'] = TRUE;
        }
      }else{
        $data['tweet'] = Tweet::limit(500)->offset($offset)->get();
      }


      //untuk sentiment opt
      $data['sentiment_opt'] = [''=>'','netral'=>'Netral','positif'=>'Positive','negatif'=>'Negatif'];

      //jika tidak melakukan submit

      //untuk keyword opt
      $keywords = Tweet::selectRaw('keyword')->groupBy('keyword')->get();
      $data['keyword_opt'][''] = '';
      foreach($keywords as $key => $value){
        $data["keyword_opt"][$value->keyword] = $value->keyword;
      }
      //menambah
      $sisa_offset = $offset % 500;
      if($sisa_offset!=0){
        $offset = $offset-$sisa_offset;
      }
      $data['offset_next'] = $offset+500;
      $data['offset_prev'] = $offset-500;

      return view('dashboard.twitter_data',$data);
    }




}
