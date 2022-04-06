<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_no')->unique();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('user_business_id');
            $table->foreign('user_business_id')->references('id')->on('user_businesses')->onDelete('cascade');
            $table->string('total_duration');
            $table->timestamp('date');
            $table->time('estimated_time');
            $table->string('payment_type')->comment('e.g: card, cash');
            $table->string('status')->default('pending')->comment('e.g: pending, done, cancelled');
            $table->float('charges','12','2')->default(0);
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
        Schema::dropIfExists('bookings');
    }
}
