<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherDataPositionHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
        Schema::create('teacher_data_position_history', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('position');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('reference_position_id');
            $table->foreign('reference_position_id')->references('id')->on('reference_positions');
            $table->date('starting_from_date');
            $table->string('number_of_decree');
            $table->string('file');
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('is_deleted');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE teacher_data_position_history ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teacher_data_position_history');
    }
}
