<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferenceActivityCreditScoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reference_activity_credit_score', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('element');
            $table->string('sub_element');
            $table->string('activity_item');
            $table->string('grain_item');
            $table->string('sub_grain_item')->nullable();
            $table->integer('code');
            $table->string('output');
            $table->float('credit_score')->nullable();
            $table->boolean('is_active');
            $table->boolean('is_deleted');
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
        Schema::dropIfExists('reference_activity_credit_score');
    }
}
