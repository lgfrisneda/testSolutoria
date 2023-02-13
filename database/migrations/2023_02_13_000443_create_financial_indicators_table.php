<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialIndicatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_indicators', function (Blueprint $table) {
            $table->id();

            // $table->integer('idInd');
            $table->string('name');
            $table->string('code');
            $table->string('unit');
            $table->double('value', 2);
            $table->date('date');
            $table->string('time')->nullable();
            $table->string('origin');

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
        Schema::dropIfExists('financial_indicators');
    }
}
