<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionRecapitulationDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
        Schema::create('promotion_recapitulation_data', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('promotion_recapitulation_id');
            $table->foreign('promotion_recapitulation_id')->references('id')->on('promotion_recapitulation');
            $table->uuid('promotion_id');
            $table->foreign('promotion_id')->references('id')->on('promotion');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE promotion_recapitulation_data ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotion_recapitulation_data');
    }
}
