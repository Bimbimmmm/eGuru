<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolutionCornerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');
      Schema::create('solution_corner', function (Blueprint $table) {
          $table->uuid('id')->primary();
          $table->date('confide_date');
          $table->text('problem');
          $table->integer('queue_number');
          $table->uuid('user_id');
          $table->foreign('user_id')->references('id')->on('users');
          $table->uuid('handles_id');
          $table->foreign('handles_id')->references('id')->on('users');
          $table->text('note')->nullable();
          $table->integer('sastifaction_level')->nullable();
          $table->text('feedback')->nullable();
          $table->boolean('is_finish');
          $table->boolean('is_deleted');
          $table->timestamps();
      });
      DB::statement('ALTER TABLE solution_corner ALTER COLUMN id SET DEFAULT uuid_generate_v4();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solution_corner');
    }
}
