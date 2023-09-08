<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreatePlayerUniformTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('player_uniform', function (Blueprint $table) {
      $table->increments('id');
      $table->string('playerCode',10)->nullable();
      $table->string('playerUniformNo',3)->nullable();
      $table->string('playerName',20);
      $table->string('uniformName',13);
      $table->dateTime('created_at')->notNullable();
      $table->dateTime('updated_at')->nullable();
    });
  }
  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('player_uniform');
  }
}
