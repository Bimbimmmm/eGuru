<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformanceTargetWorkBehaviorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
      Schema::create('performance_target_work_behavior', function (Blueprint $table) {
          $table->uuid('id')->primary();
          $table->uuid('performance_target_id');
          $table->foreign('performance_target_id')->references('id')->on('performance_target');
          $table->uuid('reference_work_behavior_id');
          $table->foreign('reference_work_behavior_id')->references('id')->on('reference_work_behavior');
          $table->double('score')->nullable();
          $table->boolean('is_deleted');
          $table->timestamps();
      });
      DB::statement('ALTER TABLE performance_target_work_behavior ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('performance_target_work_behavior');
    }
}
