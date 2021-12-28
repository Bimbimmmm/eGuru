<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
        Schema::create('promotion', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('reference_promotion_credit_score_id');
            $table->foreign('reference_promotion_credit_score_id')->references('id')->on('reference_promotion_credit_score');
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('promotion_period');
            $table->uuid('assesment_credit_id');
            $table->foreign('assesment_credit_id')->references('id')->on('assesment_credit');
            $table->float('last_promotion_credit_score');
            $table->string('old_work_year');
            $table->string('file');
            $table->boolean('is_locked');
            $table->boolean('is_finish');
            $table->string('asseseed_by')->nullable();
            $table->boolean('is_rejected');
            $table->string('rejected_reason')->nullable();
            $table->boolean('is_deleted');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE promotion ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotion');
    }
}
