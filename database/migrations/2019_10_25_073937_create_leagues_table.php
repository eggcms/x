<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leagues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('uid');
            $table->string('title_en')->nullable();
            $table->string('title_th');
            $table->string('orders')->default(1);
            $table->timestamps();
         });
   
         DB::table('leagues')->insert([
            [
               'uid' => 1,
               'title_en' => 'Premier league',
               'title_th' => 'พรีเมียร์ ลีก',
               'orders' => 1,
            ],
            [
               'uid' => 1,
               'title_en' => 'La Liga',
               'title_th' => 'ลาลีก้า',
               'orders' => 2,
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
        Schema::dropIfExists('leagues');
    }
}
