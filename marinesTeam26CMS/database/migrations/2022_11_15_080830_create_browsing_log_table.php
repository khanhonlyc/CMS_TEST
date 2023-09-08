<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateBrowsingLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('browsing_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cookie', 100)->nullable()->comment('※ハッシュ化した値を設定(SHA-256)');
            $table->string('session_id', 36)->nullable();
            $table->string('access_ip', 255)->nullable();
            $table->string('server', 255)->nullable()->comment('処理を受けたサーバIP情報');
            $table->string('method', 10)->nullable();
            $table->text('user_agent',500)->nullable();
            $table->string('referer', 255)->nullable();
            $table->string('request_url', 255)->nullable();
            $table->text('query_string', 500)->nullable();
            $table->string('marines_id', 255)->nullable();
            $table->dateTime('regist_dt')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('browsing_log');
    }
}
