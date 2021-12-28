<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferencePromotionCreditScoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reference_promotion_credit_score', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('current_rank');
          $table->string('promotion_rank');
          $table->float('cumulative_credit_score');
          $table->float('major_credit_score');
          $table->float('self_development_credit_score');
          $table->float('scientific_credit_score');
          $table->float('support_credit_score');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reference_promotion_credit_score');
    }
}
