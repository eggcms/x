<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('blogs', function (Blueprint $table) {
         $table->bigIncrements('id');
         $table->smallInteger('cid')->default(0);
         $table->smallInteger('uid')->default(0);
         $table->string('title');
         $table->text('description');
         $table->longtext('content');
         $table->string('image');
         $table->string('tag')->nullable();
         $table->text('slug')->nullable();
         $table->smallInteger('status')->default(1);
         $table->smallInteger('hot')->default(0);
         $table->smallInteger('switch1')->default(0);
         $table->smallInteger('switch2')->default(0);             
         $table->integer('visit');
         $table->dateTime('published');
         $table->string('clip')->nullable();       
         $table->timestamps();
      });
      DB::table('blogs')->insert(
         [[

            'title' => 'Test no.1 Versioning Scheme',
            'description' => 'Laravel\'s versioning scheme maintains the following convention: paradigm.major.minor.',
            'content' => 'When referencing the Laravel framework or its components from your application or package, you should always use a version constraint such as 5.8.*',
            'image' => 'noimg.jpg',
            'tag' => 'One, command, column',
            'status' => '1',
            'hot' => '0',
            'switch1' => '0',
            'switch2' => '0',
            'visit' => '0',
            'published' => date('Y-m-d H:i:s'),               
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),                
         ],
         [
            'title' => 'Test no.2 Versioning Scheme',
            'description' => 'Laravel\'s versioning scheme maintains the following convention: paradigm.major.minor.',
            'content' => 'When referencing the Laravel framework or its components from your application or package, you should always use a version constraint such as 5.8.*',
            'image' => 'noimg.jpg',
            'tag' => 'One, command, column',
            'status' => '1',
            'hot' => '0',
            'switch1' => '0',
            'switch2' => '0',
            'visit' => '0',               
            'published' => date('Y-m-d H:i:s'),               
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),               
         ]]
     ); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
