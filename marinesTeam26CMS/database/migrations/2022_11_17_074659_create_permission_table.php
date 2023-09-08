<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreatePermissionTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('permission', function (Blueprint $table) {
      $table->increments('id');
      $table->string('permission_id', 2);
      $table->string('permission_name', 50);
      $table->dateTime('created_at');
      $table->string('create_user', 20);
      $table->dateTime('deleted_at')->nullable();
      $table->string('delete_user', 10)->nullable();
    });
  }
  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('permission');
  }
}
