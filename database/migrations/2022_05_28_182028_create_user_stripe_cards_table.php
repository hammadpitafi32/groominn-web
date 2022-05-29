<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserStripeCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_stripe_cards', function (Blueprint $table) {
            $table->id();
            $table->integer('user_stripe_info_id')->nullable();
            $table->longText('card_id')->comment('Stripe generated')->nullable();
            $table->string('card_type')->nullable();
            $table->string('last_four_digit',255)->nullable();
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
        Schema::dropIfExists('user_stripe_cards');
    }
}
