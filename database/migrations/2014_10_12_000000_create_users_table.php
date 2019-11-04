<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('users', function (Blueprint $table) {
         $table->bigIncrements('id');
         $table->string('name');
         $table->string('nickname')->nullable();        
         $table->string('email')->unique();
         $table->timestamp('email_verified_at')->nullable();
         $table->string('password');
         $table->string('image')->nullable();
         $table->tinyInteger('level')->default(0);                   
         $table->rememberToken();
         $table->timestamps();
     });
     DB::table('users')->insert([
         [
             'name' => 'Super',
             'nickname' => 'พี่ซุป',
             'email' => 'superadmin@superadmin.com',
             'password' => bcrypt('superadmin@superadmin.com'),             
             'image' => 'noimg.jpg',
             'level' => 100,
             'created_at' => now(),
             'updated_at' => now(),
         ],
         [
             'name' => 'admin',
             'nickname' => 'พี่แอด',
             'email' => 'admin@admin.com',
             'password' => bcrypt('admin@admin.com'),
             'level' => 10,
             'image' => 'noimg.jpg',
             'created_at' => now(),
             'updated_at' => now(),
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
        Schema::dropIfExists('users');
    }
}
