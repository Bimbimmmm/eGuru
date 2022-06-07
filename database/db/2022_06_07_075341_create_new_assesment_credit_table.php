<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewAssesmentCreditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
        Schema::create('new_assesment_credit', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('new_performance_target_id');
            $table->foreign('new_performance_target_id')->references('id')->on('new_performance_target');
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('old_work_year');
            $table->string('new_work_year');
            $table->integer('reference_education_credit_score_id');
            $table->foreign('reference_education_credit_score_id')->references('id')->on('reference_education_credit_score');
            $table->float('last_assessment_credit_score');
            $table->string('file');
            $table->boolean('is_ready');
            $table->boolean('is_finished');
            $table->date('assessment_date')->nullable();
            $table->string('assessed_by')->nullable();
            $table->float('total_assessment_credit_score')->nullable();
            $table->boolean('is_official_approve');
            $table->boolean('is_deleted');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE new_assesment_credit ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('new_assesment_credit');
    }
}
