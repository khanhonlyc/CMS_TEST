<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateBannerTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('banner', function (Blueprint $table) {
      $table->increments('id');
      $table->enum('banner_type_code', [1, 2, 3, 4, 5]);
      $table->integer('sort_no');
      $table->string('title')->notNullable();
      $table->string('image_url');
      $table->string('url')->notNullable();
      $table->string('target')->notNullable();
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
    Schema::dropIfExists('banner');
  }
}
