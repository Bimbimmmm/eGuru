<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
        Schema::create('position_mapping', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('principal_id');
            $table->foreign('principal_id')->references('id')->on('users');
            $table->uuid('supervisor_id');
            $table->foreign('supervisor_id')->references('id')->on('users');
            $table->integer('work_unit_id');
            $table->foreign('work_unit_id')->references('id')->on('reference_work_units');
            $table->boolean('is_active');
            $table->boolean('is_deleted');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE position_mapping ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('position_mapping');
    }
}
