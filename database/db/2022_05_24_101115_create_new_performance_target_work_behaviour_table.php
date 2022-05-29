<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewPerformanceTargetWorkBehaviourTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
        Schema::create('new_performance_target_work_behaviour', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('new_performance_target_id');
            $table->foreign('new_performance_target_id')->references('id')->on('new_performance_target');
            $table->uuid('reference_new_work_behaviour_id');
            $table->foreign('reference_new_work_behaviour_id')->references('id')->on('reference_new_work_behaviour');
            $table->double('score')->nullable();
            $table->boolean('is_deleted');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE new_performance_target_work_behaviour ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('new_performance_target_work_behaviour');
    }
}
