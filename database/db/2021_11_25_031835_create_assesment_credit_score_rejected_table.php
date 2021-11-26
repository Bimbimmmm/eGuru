<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssesmentCreditScoreRejectedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
      Schema::create('assesment_credit_score_rejected', function (Blueprint $table) {
          $table->uuid('id')->primary();
          $table->uuid('assesment_credit_id');
          $table->foreign('assesment_credit_id')->references('id')->on('assesment_credit');
          $table->uuid('assesment_credit_score_id');
          $table->foreign('assesment_credit_score_id')->references('id')->on('assesment_credit_score');
          $table->uuid('performance_target_score_id');
          $table->foreign('performance_target_score_id')->references('id')->on('performance_target_score');
          $table->integer('qty');
          $table->text('reason');
          $table->text('suggestion');
          $table->timestamps();
      });
      DB::statement('ALTER TABLE assesment_credit_score_rejected ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assesment_credit_score_rejected');
    }
}
