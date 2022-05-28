<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnTypeInBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('total_duration')->nullable()->change();
            $table->string('estimated_time')->nullable()->change();
            $table->string('payment_type')->default('stripe')->comment('e.g: stripe, jazzcash, easypaisa etc.')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            if(Schema::hasColumn('bookings', 'total_duration','estimated_time','payment_type')){
                $table->string('total_duration')->change();
                $table->string('estimated_time')->change();
                $table->string('payment_type')->comment('e.g: stripe, jazzcash, easypaisa etc.')->change();
 
            }
        });
    }
}
