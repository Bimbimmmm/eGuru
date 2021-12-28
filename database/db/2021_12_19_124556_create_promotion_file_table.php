<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
        Schema::create('promotion_file', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('promotion_id');
            $table->foreign('promotion_id')->references('id')->on('promotion');
            $table->integer('reference_promotion_file_id');
            $table->foreign('reference_promotion_file_id')->references('id')->on('reference_promotion_file');
            $table->string('file')->nullable();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE promotion_file ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotion_file');
    }
}
