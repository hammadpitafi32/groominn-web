<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdColumnInUserCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->after('id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->dropColumn('name');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_categories', function (Blueprint $table) {
            if(Schema::hasColumn('user_categories', 'category_id')){
                $table->dropForeign(['category_id']);
                $table->dropColumn('category_id'); 
                $table->string('name')->after('user_id');
            }
        });
    }
}
