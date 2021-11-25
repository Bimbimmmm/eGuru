<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssesmentCreditScoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
        Schema::create('assesment_credit_score', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('assesment_credit_id');
            $table->foreign('assesment_credit_id')->references('id')->on('assesment_credit');
            $table->integer('reference_assesment_credit_score_activity_id');
            $table->foreign('reference_assesment_credit_score_activity_id')->references('id')->on('reference_assesment_credit_score_activity');
            $table->float('old_credit_score')->nullable();
            $table->float('new_user_credit_score')->nullable();
            $table->float('new_evaluator_credit_score')->nullable();
            $table->float('total_user_credit_score')->nullable();
            $table->float('total_evaluator_credit_score')->nullable();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE assesment_credit_score ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }




    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assesment_credit_score');
    }
}
