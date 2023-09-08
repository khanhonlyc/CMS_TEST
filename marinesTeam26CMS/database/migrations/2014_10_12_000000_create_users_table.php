<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('sort_no');
      $table->string('user_id');
      $table->string('password');
      $table->string('user_name');
      $table->string('permission');
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
    Schema::dropIfExists('users');
  }
}
