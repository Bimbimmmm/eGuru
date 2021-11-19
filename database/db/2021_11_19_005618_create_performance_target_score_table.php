<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformanceTargetScoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
      Schema::create('performance_target_score', function (Blueprint $table) {
          $table->uuid('id')->primary();
          $table->uuid('performance_target_id');
          $table->foreign('performance_target_id')->references('id')->on('performance_target');
          $table->integer('reference_activity_credit_score_id');
          $table->foreign('reference_activity_credit_score_id')->references('id')->on('reference_activity_credit_score');
          $table->float('target_credit_score');
          $table->integer('target_qty');
          $table->string('target_output');
          $table->integer('target_quality');
          $table->integer('target_time');
          $table->string('target_time_unit');
          $table->string('target_cost');
          $table->string('file')->nullable();
          $table->float('realization_credit_score')->nullable();
          $table->integer('realization_qty')->nullable();
          $table->string('realization_output')->nullable();
          $table->integer('realization_quality')->nullable();
          $table->integer('realization_time')->nullable();
          $table->string('realization_time_unit')->nullable();
          $table->string('realization_cost')->nullable();
          $table->float('calculation')->nullable();
          $table->float('performance_value')->nullable();
          $table->boolean('is_rejected_by_assesor')->nullable();
          $table->boolean('is_deleted');
          $table->timestamps();
      });
      DB::statement('ALTER TABLE performance_target_score ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('performance_target_score');
    }
}
