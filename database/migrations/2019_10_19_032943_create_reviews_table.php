<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('uid');
            $table->string('league');    
            $table->string('team1');
            $table->string('team2');
            $table->tinyInteger('over')->default(0);
            $table->longtext('content');
            $table->string('bet');
            $table->string('prevision');
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('orders')->default(1);
            $table->timestamps();
        });
        DB::table('reviews')->insert(
         [[
            'uid' => '1',
            'league' => 'พรีเมียร์ลีก',
            'team1' => 'เอฟเวอร์ตัน',
            'team2' => 'เวสต์แฮม ยูไนเต็ด',
            'over' => '1',
            'content' => 'เอฟเวอร์ตันตอนนี้อาการหนักผลงานย่ำแย่และมาเจอเวสต์แฮมช่วงขาขึ้นลุ้นมากสุดน่าจะแค่แต้มเดียว',
            'bet' => 'รอง เวสต์แฮม 0.5',
            'prevision' => 'เวสต์แฮม เสมอ 2-2 (สกอร์สูง)',
            'status' => '1',
            'orders' => '1',               
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),                
         ],
         [
            'uid' => '2',
            'league' => 'พรีเมียร์ลีก',
            'team1' => 'แอสตัน วิลล่า',
            'team2' => 'ไบรท์ตัน',
            'over' => '1',
            'content' => 'วิลล่ายิ่งเล่นยิ่งดูมั่นใจแนวรุกโดดเด่นเป็นจุดขายไบรท์ตันพึ่งตบสเปอร์สมาจริงแต่วันนี้น่าจะยิงไม่ออก',
            'bet' => ' ่อ แอสตัน วิลล่า ปป',
            'prevision' => 'แอสตัน วิลล่า ชนะ 2-1',
            'status' => '1',
            'orders' => '2',               
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
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
        Schema::dropIfExists('reviews');
    }
}
