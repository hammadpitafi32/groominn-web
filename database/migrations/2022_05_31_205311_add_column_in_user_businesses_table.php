<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInUserBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_businesses', function (Blueprint $table) {
            $table->integer('no_of_employees')->default(1)->after('longitude');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_businesses', function (Blueprint $table) {
             if(Schema::hasColumn('user_businesses','no_of_employees')){
                $table->dropColumn('no_of_employees'); 
            }
        });
    }
}
