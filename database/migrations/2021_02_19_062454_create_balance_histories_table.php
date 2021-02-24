<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->float('balance');
            $table->float('rate_per_sms')->nullable();
            $table->float('coins');
            $table->foreignId('payment_type')->nullable();
            $table->foreignId('added_by')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreign('payment_type')
                ->references('id')
                ->on('payments');

            $table->foreign('added_by')
                ->references('id')
                ->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('balance_histories', function(Blueprint $table){
            $table->dropForeign(['user_id']);
            $table->dropForeign(['payment_type']);
            $table->dropForeign(['added_by']);
        });
        Schema::dropIfExists('balance_histories');
    }
}
