<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateManagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manager', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('sort_no');
          $table->string('user_id',10);
          $table->string('password')->notNullable();
          $table->string('user_name')->notNullable();
          $table->string('permission');
          $table->dateTime('created_at');
          $table->string('create_user',10);
          $table->dateTime('updated_at');
          $table->string('update_user');
          $table->dateTime('deleted_at');
          $table->string('delete_user',10);
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manager');
    }
}
