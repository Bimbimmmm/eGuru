<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrincipalMappingFinishTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
        Schema::create('principal_mapping_finish', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('principal_mapping_id');
            $table->foreign('principal_mapping_id')->references('id')->on('principal_mapping');
            $table->integer('reference_subject_id');
            $table->foreign('reference_subject_id')->references('id')->on('reference_subject');
            $table->integer('total_hour');
            $table->integer('total_teacher_need');
            $table->integer('total_teacher_hour');
            $table->integer('total_teacher');
            $table->integer('total_difference');
            $table->boolean('is_excess');
            $table->boolean('is_ideal');
            $table->boolean('is_lack');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE principal_mapping_finish ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('principal_mapping_finish');
    }
}
