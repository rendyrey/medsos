<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSentimenTweet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         //
         Schema::table('tweet', function (Blueprint $table) {
             $table->text('sentiment')->after('tweet')->nullable();
             $table->string('keyword')->after('sentiment')->nullable();
             $table->string('lokasi')->after('keyword')->nullable();
             $table->date('start_date')->after('lokasi');
             $table->date('end_date')->after('start_date');
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         //
         Schema::table('tweet', function (Blueprint $table) {
             //
             $table->dropColumn('sentiment');
             $table->dropColumn('keyword');
             $table->dropColumn('lokasi');
             $table->dropColumn('start_date');
             $table->dropColumn('end_date');
         });
     }
}
