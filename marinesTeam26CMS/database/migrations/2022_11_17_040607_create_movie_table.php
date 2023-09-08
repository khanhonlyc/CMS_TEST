<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateMovieTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('movie', function (Blueprint $table) {
      $table->increments('id');
      $table->enum('movie_type_code',[1, 2]);
      $table->integer('sort_no');
      $table->string('title')->notNullable();
      $table->string('thumbnail_url')->nullable();
      $table->string('sauce')->comment('targetタグ');;
      $table->string('fan_type_code');
      $table->dateTime('publish_start')->nullable();
      $table->dateTime('publish_end')->nullable();
      $table->integer('status')->length(1);
      $table->dateTime('created_at')->nullable();
      $table->string('create_user')->nullable();
      $table->dateTime('updated_at')->nullable();
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
  public function down()
  {
    Schema::dropIfExists('movie');
  }
}
