<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnNameInUserBusinessCategoryServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_business_category_services', function (Blueprint $table) {
            $table->renameColumn('category_id', 'user_category_id');
            $table->renameColumn('service_id', 'user_service_id');

            $table->dropForeign(['category_id']);
            $table->dropForeign(['service_id']);

            $table->foreign('user_category_id')->references('id')->on('user_categories')->onDelete('cascade');
            $table->foreign('user_service_id')->references('id')->on('user_services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_business_category_services', function (Blueprint $table) {
            $table->renameColumn('user_category_id', 'category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->renameColumn('user_service_id', 'service_id');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');

        });
    }
}
