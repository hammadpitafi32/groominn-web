<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBusinessSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_business_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_business_id');
            $table->foreign('user_business_id')->references('id')->on('user_businesses')->onDelete('cascade');
            $table->string('day');
            $table->time('open_at')->comment('shop opening time');
            $table->time('close_at')->comment('shop closing time');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_business_schedules');
    }
}
