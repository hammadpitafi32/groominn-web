<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_businesses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->longText('description');
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state_id')->nullable();
            $table->string('country_id')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->string('cnic_front')->nullable()->comment('info: National card front picture');
            $table->string('cnic_back')->nullable()->comment('info: National card back picture');
            $table->string('license')->nullable()->comment('info: Business license picture');
            $table->string('status')->default('inactive')->comment('e.g: active , inactive , suspended');
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
        Schema::dropIfExists('user_businesses');
    }
}
