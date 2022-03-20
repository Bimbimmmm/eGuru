<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
      Schema::create('leave_permissions', function (Blueprint $table) {
          $table->uuid('id')->primary();
          $table->uuid('user_id');
          $table->foreign('user_id')->references('id')->on('users');
          $table->integer('leave_type_id');
          $table->foreign('leave_type_id')->references('id')->on('reference_leave_type');
          $table->integer('leave_year')->nullable();
          $table->string('leave_excuse');
          $table->string('leave_duration');
          $table->date('start_date');
          $table->date('end_date');
          $table->string('leave_address');
          $table->uuid('position_mapping_id');
          $table->foreign('position_mapping_id')->references('id')->on('position_mapping');
          $table->boolean('is_direct_supervisor_approve');
          $table->string('direct_supervisor_note')->nullable();
          $table->boolean('is_official_approve');
          $table->string('official_note')->nullable();
          $table->string('file_recommendation_letter')->nullable();
          $table->string('file_temporary_permission')->nullable();
          $table->string('file_leave_application')->nullable();
          $table->string('file_proof')->nullable();
          $table->boolean('is_rejected');
          $table->boolean('is_deleted');
          $table->timestamps();
      });
      DB::statement('ALTER TABLE leave_permissions ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_permissions');
    }
}
