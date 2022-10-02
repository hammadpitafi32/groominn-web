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
            $table->longText('cancel_detail')->nullable()->after('charges');
            $table->longText('cancel_by')->nullable()->after('cancel_detail');
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
            if(Schema::hasColumn('bookings','cancel_detail','cancel_by')){
                $table->dropColumn('cancel_detail'); 
                $table->dropColumn('cancel_by'); 
            }
        });
    }
}
