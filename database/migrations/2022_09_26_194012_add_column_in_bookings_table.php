<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('payment_intent_id')->nullable()->after('payment_type');
            $table->longText('cancel_detail')->nullable()->after('charges');
            $table->integer('cancel_by')->nullable()->after('cancel_detail');
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
            if(Schema::hasColumn('bookings','payment_intent_id','cancel_detail','cancel_by')){
                $table->dropColumn('payment_intent_id'); 
                $table->dropColumn('cancel_detail'); 
                $table->dropColumn('cancel_by'); 
            }
        });
    }
}
