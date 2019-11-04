<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
   {
      Schema::create('groups', function (Blueprint $table) {
         $table->bigIncrements('id');
         $table->tinyInteger('gid')->default(0);
         $table->string('title');            
         $table->mediumText('description');
         $table->string('orders')->default(1);
         $table->tinyInteger('status')->default(1);
         $table->timestamps();
     });
     DB::table('groups')->insert([
      [
         'gid' => 0,
         'title' => 'ฟุตบอลไทย',
         'description' => 'รวบรวมข่าวสารฟุตบอลไทย ข้อมูลผู้เล่นฟุตบอลไทย บทวิเคราะห์ฟุตบอลไทย จากบรรดาเซียนระดับเทพ',
         'orders' => 1,
         'status' => 1,
      ],
      [
         'gid' => 0,
         'title' => 'ฟุตบอลต่างประเทศ',
         'description' => 'รวบรวมข่าวสารฟุตบอลต่างประเทศ ข้อมูลผู้เล่นฟุตบอลต่างประเทศ บทวิเคราะห์ฟุตบอลต่างประเทศ จากบรรดาเซียนระดับเทพ',
         'orders' => 2,
         'status' => 1,
      ],
      [
         'gid' => 0,
         'title' => 'ข่าวกีฬา',
         'description' => 'รวบรวมข่าวกีฬาจากทั่วทุกมุมโลก อีกทั้งบทวิเคราะห์จากบรรดากูรู รู้ลึกรู้จริง',
         'orders' => 3,
         'status' => 1,
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
        Schema::dropIfExists('groups');
    }
}
