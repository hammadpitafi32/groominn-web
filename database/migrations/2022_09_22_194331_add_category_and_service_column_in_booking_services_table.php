<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryAndServiceColumnInBookingServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('booking_services', function (Blueprint $table) {
            $table->string('category_name')->after('user_business_category_service_id');
            $table->string('service_name')->after('category_name');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('booking_services', function (Blueprint $table) {
            if(Schema::hasColumn('booking_services','category_name','service_name')){
                $table->dropColumn('category_name'); 
                $table->dropColumn('service_name'); 
            }
        });
    }
}
