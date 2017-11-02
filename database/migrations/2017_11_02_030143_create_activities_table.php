<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); //活动名称
            $table->string('picture')->nullable(); //活动大图
            $table->dateTime('start_time'); //开始时间
            $table->dateTime('end_time')->nullable();; //结束时间
            $table->integer('active_people')->nullable();; //人数
            $table->longText('content'); //人数
            $table->string('sponsor'); //主办方
            $table->string('contractor')->nullable(); //承办方
            $table->integer('status')->default(0); //状态:0:未开始
            $table->integer('order')->nullable(); //预约开关
            $table->integer('type'); //活动类型
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
        Schema::dropIfExists('activities');
    }
}
