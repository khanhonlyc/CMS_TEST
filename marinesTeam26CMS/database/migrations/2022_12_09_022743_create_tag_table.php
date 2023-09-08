<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('tag_id')->unique();
          $table->string('tag_name')->unique();
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
        Schema::dropIfExists('tag');
    }
}
