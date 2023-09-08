<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateFanTypeNameEnTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('fan_type_name_en', function (Blueprint $table) {
      $table->increments('id');
      $table->string('fantypecode', 10)->notNullable()->comment('FmaMemberPersonalData.fanTypeCode');
      $table->string('fantypename', 100)->notNullable()->comment('対応する英語名を入力');
      $table->string('fantypenameen', 100)->notNullable()->comment('対応する英語名を入力');
      $table->dateTime('created_at')->notNullable()->comment('登録日時');
      $table->string('create_user')->notNullable();
      $table->dateTime('updated_at')->notNullable();
      $table->string('update_user')->nullable();
      $table->dateTime('deleted_at')->nullable();
      $table->string('delete_user')->nullable();
    });
  }
  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('fan_type_name_en');
  }
}
