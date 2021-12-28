<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionScoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
      Schema::create('promotion_score', function (Blueprint $table) {
          $table->uuid('id')->primary();
          $table->uuid('promotion_id');
          $table->foreign('promotion_id')->references('id')->on('promotion');
          $table->integer('reference_assesment_credit_score_activity_id');
          $table->foreign('reference_assesment_credit_score_activity_id')->references('id')->on('reference_assesment_credit_score_activity');
          $table->float('old_credit_score')->nullable();
          $table->float('new_credit_score')->nullable();
          $table->float('get_credit_score')->nullable();
          $table->timestamps();
      });
      DB::statement('ALTER TABLE promotion_score ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotion_score');
    }
}
