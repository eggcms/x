<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Pages', function (Blueprint $table) {
         $table->bigIncrements('id');
         $table->smallInteger('pid')->default(0);
         $table->smallInteger('uid')->default(1);
         $table->string('title');
         $table->text('description');
         $table->longtext('content');
         $table->string('tag')->nullable();
         $table->text('slug')->nullable();
         $table->smallInteger('status')->default(1);
         $table->smallInteger('switch1')->default(0);
         $table->smallInteger('switch2')->default(0);             
         $table->integer('visit');    
         $table->timestamps();
      });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
