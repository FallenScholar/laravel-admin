<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->char('group', 16)->comment('分类')->index();
            $table->char('type', 16)->comment('类型')->index();
            $table->char('key', 32)->comment('键')->unique();
            $table->string('value', 255)->default('')->comment('值');
            $table->string('help')->default('')->comment('帮助文档');
            $table->string('rules')->default('')->comment('验证规则');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configs');
    }
}
