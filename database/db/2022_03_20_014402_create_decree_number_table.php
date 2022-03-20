<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDecreeNumberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('decree_number', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('type');
        $table->uuid('leave_permissions_id')->nullable();
        $table->foreign('leave_permissions_id')->references('id')->on('leave_permissions');
        $table->uuid('salary_increase_id')->nullable();
        $table->foreign('salary_increase_id')->references('id')->on('salary_increase');
        $table->string('month');
        $table->integer('year');
        $table->string('assesed_by');
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
        Schema::dropIfExists('decree_number');
    }
}
