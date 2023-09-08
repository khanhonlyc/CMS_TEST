<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateUniformRegistrationTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('uniform_registration', function (Blueprint $table) {
      $table->increments('id');
      $table->string('amcno', 10)->notNullable()->comment('マリーンズID、89xxxxxxx');
      $table->string('name', 13)->notNullable()->comment('ユニフォームに記載する名前（アルファベット）');
      $table->string('uniformnum', 3)->notNullable()->comment('ユニフォームに記載する背番号');
      $table->dateTime('created_at')->notNullable()->comment('登録日時');
      $table->dateTime('updated_at')->notNullable()->comment('更新を実行した日時を登録する');
    });
  }
  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('uniform_registration');
  }
}
