<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferencePerformanceTargetElementTable extends Migration
{
    /**
     * Run the migrations.
     *ph
     * @return void
     */
    public function up()
    {
        Schema::create('reference_performance_target_element', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('element');//kinerja utama
            $table->string('direct_supervisor_performance_plan');//Pengelolaan Standar Isi, Kelulusan, Proses, dan Penilaian pada 8 Standar Nasional Pendidikan.
            $table->string('performance_plan');//Tersusunnya perencanaan perangkat pembelajaran/ bimbingan: action plan, silabus, RPP/RPL, bahan dan administrasi mengajar.
            $table->string('activity_item');//Menyusun Perangkat Pembelajaran Guru: Action Plan (Analisis Minggu Efektif, Prota, Promes).
            $table->string('yield_unit');//Dokumen
            $table->float('credit_score')->nullable();//20.250
            $table->string('quantity');//Jumlah dokumen perencanaan pembelajaran Prakarya Kewirausahaan kelas X dan Seni Budaya kelas XII.
            $table->string('quality');//Capaian persentase penyusunan dokumen perencanaan pembelajaran.
            $table->string('time');//Waktu penyelesaian dokumen perencanaan pembelajaran.
            $table->integer('code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reference_performance_target_element');
    }
}
