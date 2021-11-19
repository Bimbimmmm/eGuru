<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformanceTargetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
        Schema::create('performance_target', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('work_unit_id');
            $table->foreign('work_unit_id')->references('id')->on('reference_work_units');
            $table->integer('assessment_year');
            $table->integer('rank_id');
            $table->foreign('rank_id')->references('id')->on('reference_ranks');
            $table->integer('period');
            $table->uuid('position_mapping_id');
            $table->foreign('position_mapping_id')->references('id')->on('position_mapping');
            $table->float('performance_score')->nullable();
            $table->boolean('is_ready');
            $table->boolean('is_direct_supervisor_approve');
            $table->date('direct_supervisor_asseseed_time')->nullable();
            $table->boolean('is_official_approve');
            $table->date('official_asseseed_time')->nullable();
            $table->boolean('is_correction');
            $table->text('correction_note')->nullable();
            $table->string('file_lesson_plan');
            $table->string('file_instrument');
            $table->string('file_mapping');
            $table->boolean('is_deleted');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE performance_target ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('performance_target');
    }
}
