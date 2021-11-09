<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
        Schema::create('personal_data', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('registration_number');
            $table->string('id_number');
            $table->string('educator_number');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('gender');
            $table->uuid('marital_status_id');
            $table->foreign('marital_status_id')->references('id')->on('reference_marital_status');
            $table->uuid('religion_id');
            $table->foreign('religion_id')->references('id')->on('reference_religions');
            $table->uuid('rank_id');
            $table->foreign('rank_id')->references('id')->on('reference_ranks');
            $table->uuid('work_unit_id');
            $table->foreign('work_unit_id')->references('id')->on('reference_work_units');
            $table->uuid('position_id');
            $table->foreign('position_id')->references('id')->on('reference_positions');
            $table->uuid('status_id');
            $table->foreign('status_id')->references('id')->on('reference_status');
            $table->uuid('education_id');
            $table->foreign('education_id')->references('id')->on('reference_educations');
            $table->date('cs_year')->nullable();
            $table->date('cs_candidate_year');
            $table->string('tax_number');
            $table->string('teacher_type')->nullable();
            $table->string('address');
            $table->string('province');
            $table->string('city');
            $table->string('district');
            $table->string('village');
            $table->string('zip_code');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE personal_datas ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_datas');
    }
}
