<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('send_by')->nullable();
            $table->bigInteger('send_to');
            $table->longText('message');
            $table->integer('coins_used');
            $table->integer('status')->nullable();
            $table->timestamps();

            $table->foreign('send_by')
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
        Schema::table('sms_histories', function(Blueprint $table){
            $table->dropForeign(['send_by']);
        });
        Schema::dropIfExists('sms_histories');
    }
}
