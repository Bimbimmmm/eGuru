<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewPerformanceTargetScoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
      Schema::create('new_performance_target_score', function (Blueprint $table) {
          $table->uuid('id')->primary();
          $table->uuid('new_performance_target_id');
          $table->foreign('new_performance_target_id')->references('id')->on('new_performance_target');
          $table->integer('reference_performance_target_element_id');
          $table->foreign('reference_performance_target_element_id')->references('id')->on('reference_performance_target_element');
          $table->float('target_credit_score')->nullable();
          $table->integer('target_qty');
          $table->integer('target_quality');
          $table->integer('target_time');
          $table->string('file')->nullable();
          $table->float('realization_credit_score')->nullable();
          $table->integer('realization_qty')->nullable();
          $table->integer('ach_qty')->nullable();
          $table->string('cat_qty')->nullable();
          $table->integer('realization_quality')->nullable();
          $table->integer('ach_quality')->nullable();
          $table->string('cat_quality')->nullable();
          $table->integer('realization_time')->nullable();
          $table->integer('ach_time')->nullable();
          $table->string('cat_time')->nullable();
          $table->string('category')->nullable();
          $table->float('score')->nullable();
          $table->float('weighted_value')->nullable();
          $table->boolean('is_rejected_by_assesor');
          $table->boolean('is_deleted');
          $table->timestamps();
      });
      DB::statement('ALTER TABLE new_performance_target_score ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('new_performance_target_score');
    }
}
