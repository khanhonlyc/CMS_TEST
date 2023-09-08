<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateViewedMessagesTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('viewed_messages', function (Blueprint $table) {
      $table->increments('id');
      $table->string('amcno', 10)->notNullable()->comment('マリーンズID、89xxxxxxx');
      $table->string('messageid', 6)->notNullable()->comment('FmaMemberMessageのmessageList,personalMessageListのmessageIdを格納する');
      $table->dateTime('created_at')->notNullable()->comment('登録日時');
    });
  }
  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('viewed_messages');
  }
}
