<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrafficTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traffic', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->constrained('campaigns')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('services')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('operator_id')->constrained('operators')->onUpdate('cascade')->onDelete('cascade');
            $table->string('clicked_id')->nullable();
            $table->string('others')->nullable();
            $table->dateTime('received_at');
            $table->enum('callback_received_status', ['succeed', 'failed'])->default('failed');
            $table->enum('callback_sent_status', ['sent', 'unsent'])->default('unsent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('traffic');
    }
}
