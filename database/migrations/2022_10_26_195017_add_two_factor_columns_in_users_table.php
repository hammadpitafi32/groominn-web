<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTwoFactorColumnsInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('two_factor_code')->nullable()->after('role_id');
            $table->boolean('is_verified')->default(false)->after('two_factor_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if(Schema::hasColumn('users','two_factor_code','is_verified')){
                $table->dropColumn('two_factor_code'); 
                $table->dropColumn('is_verified'); 
            }
        });
    }
}
