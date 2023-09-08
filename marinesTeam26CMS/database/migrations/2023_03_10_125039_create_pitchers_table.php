<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePitchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pitchers', function (Blueprint $table) {
            $table->id();
            $table->string('teamCode')->nullable()->comment('チームコード');
            $table->string('playerCode')->nullable()->comment('選手コード');
            $table->string('playerName')->nullable()->comment('選手名');
            $table->string('G')->nullable()->comment('試合');
            $table->string('CG')->nullable()->comment('完投');
            $table->string('SHO')->nullable()->comment('完封');
            $table->string('noWalks')->nullable()->comment('無四球');
            $table->string('W')->nullable()->comment('勝利');
            $table->string('L')->nullable()->comment('敗戦');
            $table->string('D')->nullable()->comment('引分数');
            $table->string('SV')->nullable()->comment('セーブ');
            $table->string('HLD')->nullable()->comment('ホールド');
            $table->string('HLDP')->nullable()->comment('ホールドポイント');
            $table->string('WPCT')->nullable()->comment('勝率');
            $table->string('BF')->nullable()->comment('対戦打者数');
            $table->string('AB')->nullable()->comment('対戦打数');
            $table->string('IP')->nullable()->comment('投球回');
            $table->string('IP3')->nullable()->comment('投球回端数');
            $table->string('H')->nullable()->comment('被安打');
            $table->string('HR')->nullable()->comment('被本塁打');
            $table->string('SH')->nullable()->comment('被犠打');
            $table->string('SF')->nullable()->comment('被犠飛');
            $table->string('BB')->nullable()->comment('与四球');
            $table->string('IBB')->nullable()->comment('与故意四球');
            $table->string('HP')->nullable()->comment('与死球');
            $table->string('SO')->nullable()->comment('奪三振');
            $table->string('WP')->nullable()->comment('暴投');
            $table->string('BK')->nullable()->comment('ボーク');
            $table->string('R')->nullable()->comment('失点');
            $table->string('ER')->nullable()->comment('自責点');
            $table->string('ERA')->nullable()->comment('防御率');
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
        Schema::dropIfExists('pitchers');
    }
}
