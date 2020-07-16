<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::create('counter_ips', function (Blueprint $table) {
            $table->string('ip', 15);
            $table->dateTime('visit');
            $table->string('session', 150);
        });
        Schema::create('counter_values', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('day_id');
            $table->bigInteger('day_value');
            $table->bigInteger('yesterday_id');
            $table->bigInteger('yesterday_value');
            $table->bigInteger('week_id');
            $table->bigInteger('week_value');
            $table->bigInteger('month_id');
            $table->bigInteger('month_value');
            $table->bigInteger('year_id');
            $table->bigInteger('year_value');
            $table->bigInteger('all_value');
            $table->dateTime('record_date');
            $table->bigInteger('record_value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('counter_ips');
        Schema::dropIfExists('counter_values');
    }
}
