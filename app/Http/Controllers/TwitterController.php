<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tweet;

class TwitterController extends Controller
{
    //
    public function store(Request $request){
      ini_set('memory_limit','256M');

      $csv=$request->file('file');
      $csv->move(public_path('file_tweet/'),$csv->getClientOriginalName());

      $nama_file = $csv->getClientOriginalName();
      $ext = $csv->getClientOriginalExtension();
      $path = url('public/file_tweet/'.$nama_file);

      // we check,file must be have csv extention
      if($ext=="csv")
      {
        $file = fopen($path, "r");
        set_time_limit(0);
        $date_range = $request->date_range;
        $start_date = substr($date_range,0,10);
        $end_date = substr($date_range,-10);
        while (($emapData = fgetcsv($file, 10000, "|")) !== FALSE)
        {
          $tweet = new Tweet;
          $tweet->tweet_id = $emapData[0];
          $tweet->date = $emapData[1];
          $tweet->time = $emapData[2];
          $tweet->timezone = $emapData[3];
          $tweet->username = $emapData[4];
          $tweet->tweet = $emapData[5];
          $tweet->sentiment = $this->get_sentiment($emapData[5]);
          $tweet->keyword = $request->keyword;
          $tweet->lokasi = $request->lokasi;
          $tweet->start_date = $start_date;
          $tweet->end_date = $end_date;
          $tweet->save();
        }
        fclose($file);
        echo "CSV File has been successfully Imported.";
      }
      else {
        echo "Error: Please Upload only CSV File";
      }
    }

    public static function get_sentiment($string){
      $data['string'] = $string;
      return view('sentiment.examples.calculate_sentiment',$data);
    }
}
