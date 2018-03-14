<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    //
    protected $table = 'tweet';
    protected $fillable = [
      'tweet_id',
      'date',
      'time',
      'timezone',
      'username',
      'tweet',
      'sentiment',
      'keyword',
      'lokasi',
      'start_date',
      'end_date'
    ];
}
