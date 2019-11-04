<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddedUserProfileFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function (Blueprint $table) {
         $table->string('facebook')->nullable()->after('level');
         $table->string('line')->nullable()->after('facebook');
         $table->string('mobile')->nullable()->after('line');
         $table->string('memo')->nullable()->after('mobile');
         $table->string('status')->default(1)->after('memo');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('memo');
            $table->dropColumn('facebook');
            $table->dropColumn('line');
            $table->dropColumn('mobile');
            $table->dropColumn('memo');
            $table->dropColumn('status');      //
        });
    }
}
