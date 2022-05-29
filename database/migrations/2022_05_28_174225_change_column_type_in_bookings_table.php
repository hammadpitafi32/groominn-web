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

            /*add stripe column*/

            $table->string('billing_id')->nullable()->after('payment_type');
            $table->string('balance_transaction')->nullable()->after('billing_id');
            $table->string('billing_status')->nullable()->after('balance_transaction');
            $table->string('receipt_url')->nullable()->after('billing_status');
            $table->string('refund_id')->nullable()->after('receipt_url');

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
            if(Schema::hasColumn('bookings', 'total_duration','estimated_time','payment_type','billing_id','balance_transaction','billing_status','receipt_url','refund_id')){
                $table->string('total_duration')->change();
                $table->string('estimated_time')->change();
                $table->string('payment_type')->comment('e.g: stripe, jazzcash, easypaisa etc.')->change();

                $table->dropColumn('billing_id');
                $table->dropColumn('balance_transaction');
                $table->dropColumn('billing_status');
                $table->dropColumn('receipt_url');
                $table->dropColumn('refund_id');

 
            }
        });
    }
}
