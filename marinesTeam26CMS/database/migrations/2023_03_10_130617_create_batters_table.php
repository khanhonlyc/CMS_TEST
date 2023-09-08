<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBattersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batters', function (Blueprint $table) {
            $table->id();
            $table->string('teamCode')->nullable()->comment('チームコード');
            $table->string('playerCode')->nullable()->comment('選手コード');
            $table->string('playerName')->nullable()->comment('選手名');
            $table->string('G')->nullable()->comment('試合');
            $table->string('PA')->nullable()->comment('打席');
            $table->string('AB')->nullable()->comment('打数');
            $table->string('R')->nullable()->comment('得点');
            $table->string('H')->nullable()->comment('安打');
            $table->string('2B')->nullable()->comment('二塁打');
            $table->string('3B')->nullable()->comment('三塁打');
            $table->string('HR')->nullable()->comment('本塁打');
            $table->string('TB')->nullable()->comment('塁打数');
            $table->string('RBI')->nullable()->comment('打点');
            $table->string('SB')->nullable()->comment('盗塁');
            $table->string('CS')->nullable()->comment('盗塁刺');
            $table->string('SH')->nullable()->comment('犠打');
            $table->string('SF')->nullable()->comment('犠飛');
            $table->string('BB')->nullable()->comment('四球');
            $table->string('IBB')->nullable()->comment('故意四球');
            $table->string('HP')->nullable()->comment('死球');
            $table->string('SO')->nullable()->comment('三振');
            $table->string('GDP')->nullable()->comment('併殺打');
            $table->string('LOB')->nullable()->comment('残塁');
            $table->string('AVG')->nullable()->comment('打率');
            $table->string('SLG')->nullable()->comment('長打率');
            $table->string('OBP')->nullable()->comment('出塁率');
            $table->string('IF')->nullable()->comment('妨害出塁');
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
        Schema::dropIfExists('batters');
    }
}
