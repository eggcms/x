<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
         $table->bigIncrements('id');
         $table->integer('uid');
         $table->integer('league');
         $table->string('team1');
         $table->string('team2');
         $table->string('score1')->default('?');
         $table->string('score2')->default('?');        
         $table->tinyInteger('home')->default(0);
         $table->string('channel')->nullable();
         $table->string('date');
         $table->integer('hot')->default(0);
         $table->timestamps();
        });

        DB::table('results')->insert([
         [
            'uid' => 1,
            'league' => 1,
            'team1' => 'แมนเชสเตอร์ ยูไนเต็ด',
            'team2' => 'ลิเวอร์พลู',
            'score1' => '?',
            'score2' => '?',
            'home' => 1,
            'channel' => 'thairat tv',
            'date' => '?',
            'hot' => 0,
         ],
         [
            'uid' => 1,
            'league' => 1,
            'team1' => 'อาเซนอล',
            'team2' => 'เชลซี',
            'score1' => '?',
            'score2' => '?',
            'home' => 2,
            'channel' => 'true tv',
            'date' => '?',
            'hot' => 0,
         ],
         ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('results');
    }
}
