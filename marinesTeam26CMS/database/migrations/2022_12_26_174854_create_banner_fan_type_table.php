<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateBannerFanTypeTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('banner_fan_type', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('banner_id');
      $table->integer('fan_type_name_en_id');
    });
  }
  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('banner_fan_type');
  }
}
