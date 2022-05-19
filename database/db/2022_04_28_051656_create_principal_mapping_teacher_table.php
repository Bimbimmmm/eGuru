<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrincipalMappingTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
        Schema::create('principal_mapping_teacher', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('principal_mapping_subject_id');
            $table->foreign('principal_mapping_subject_id')->references('id')->on('principal_mapping_subject');
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('teaching_hour');
            $table->boolean('is_certification');
            $table->boolean('is_deleted');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE principal_mapping_teacher ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('principal_mapping_teacher');
    }
}
