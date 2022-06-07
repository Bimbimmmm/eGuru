<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewAssesmentCreditScoreRejectedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
        Schema::create('new_assesment_credit_score_rejected', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('new_assesment_credit_id');
            $table->foreign('new_assesment_credit_id')->references('id')->on('new_assesment_credit');
            $table->uuid('new_assesment_credit_score_id');
            $table->foreign('new_assesment_credit_score_id')->references('id')->on('new_assesment_credit_score');
            $table->uuid('new_performance_target_score_id');
            $table->foreign('new_performance_target_score_id')->references('id')->on('new_performance_target_score');
            $table->integer('qty');
            $table->text('reason');
            $table->text('suggestion');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE new_assesment_credit_score_rejected ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('new_assesment_credit_score_rejected');
    }
}
