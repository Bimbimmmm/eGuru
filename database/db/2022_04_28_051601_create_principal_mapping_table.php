<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrincipalMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
        Schema::create('principal_mapping', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('school_type');
            $table->integer('study_year');
            $table->string('school_statistic_number');
            $table->string('national_school_number');
            $table->date('school_date');
            $table->string('school_accreditation');
            $table->integer('work_unit_id');
            $table->foreign('work_unit_id')->references('id')->on('reference_work_units');
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('principal_starting_from_date');
            $table->integer('total_study_group');
            $table->integer('total_student');
            $table->boolean('is_locked');
            $table->boolean('is_finish');
            $table->boolean('is_deleted');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE principal_mapping ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('principal_mapping');
    }
}
