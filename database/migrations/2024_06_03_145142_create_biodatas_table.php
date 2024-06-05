<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiodatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biodatas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('foto')->nullable();
            $table->string('nomor_lamar')->nullable();
            $table->string('nomor_hp')->nullable();
            $table->string('nama')->nullable();
            $table->unsignedSmallInteger('usia')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->unsignedSmallInteger('tinggi_badan')->nullable();
            $table->unsignedSmallInteger('berat_badan')->nullable();
            $table->enum('agama', ['MOESLIM', 'CRISTIAN', 'HINDU', 'BOEDHA'])->nullable();
            $table->enum('lulusan', ['Elementary School', 'Junior High School', 'Senior Highschool', 'University'])->nullable();
            $table->enum('status_nikah', ['SINGLE', 'MARRIED', 'DIVORCED', 'WIDOW'])->nullable();
            $table->string('jumlah_anak')->nullable();
            $table->string('jumlah_saudara')->nullable();
            $table->unsignedSmallInteger('anak_ke')->nullable();
            $table->enum('pengalaman_luarnegeri', ['YES', 'NO'])->nullable();
            $table->string('ket_pengalaman_luarnegeri')->nullable();
            $table->enum('pengalaman_lokal', ['YES', 'NO'])->nullable();
            $table->string('ket_pengalaman_lokal')->nullable();
            $table->enum('housekeeping', ['YES', 'NO'])->nullable();
            $table->enum('babysitting', ['YES', 'NO'])->nullable();
            $table->enum('careofbabies', ['POOR', 'FAIR', 'GOOD', 'VERY GOOD'])->nullable();
            $table->enum('careofyoung', ['POOR', 'FAIR', 'GOOD', 'VERY GOOD'])->nullable();
            $table->enum('householdworks', ['POOR', 'FAIR', 'GOOD', 'VERY GOOD'])->nullable();
            $table->enum('personality', ['POOR', 'FAIR', 'GOOD', 'VERY GOOD'])->nullable();
            $table->enum('facialexpression', ['POOR', 'FAIR', 'GOOD', 'VERY GOOD'])->nullable();
            $table->enum('careofelderly', ['POOR', 'FAIR', 'GOOD', 'VERY GOOD'])->nullable();
            $table->enum('cooking', ['POOR', 'FAIR', 'GOOD', 'VERY GOOD'])->nullable();
            $table->enum('housmaid', ['POOR', 'FAIR', 'GOOD', 'VERY GOOD'])->nullable();
            $table->enum('spokenenglish', ['POOR', 'FAIR', 'GOOD', 'VERY GOOD'])->nullable();
            $table->enum('spokencantonese', ['POOR', 'FAIR', 'GOOD', 'VERY GOOD'])->nullable();
            $table->enum('spokenmandarin', ['POOR', 'FAIR', 'GOOD', 'VERY GOOD'])->nullable();
            $table->enum('afraidofdog', ['YES', 'NO'])->nullable();
            $table->enum('caringdog', ['YES', 'NO'])->nullable();
            $table->string('nama_suami')->nullable();
            $table->string('usia_suami')->nullable();
            $table->string('pekerjaan_suami')->nullable();
            $table->unsignedSmallInteger('anakke_suami')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('usia_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('usia_ibu')->nullable();
            $table->text('alamat_ortu')->nullable();

            $table->json('pengalaman')->nullable();
            // $table->text('nama_majikan')->nullable();
            // $table->text('alamat_majikan')->nullable();
            // $table->text('tahun_mulai')->nullable();
            // $table->text('tahun_selesai')->nullable();
            // $table->text('gaji')->nullable();
            // $table->text('alasan_selesai')->nullable();
            // $table->text('keterangan')->nullable();

            $table->unsignedBigInteger('tujuan_id')->nullable();
            $table->unsignedBigInteger('kantor_id')->nullable();
            $table->unsignedBigInteger('marketing_id')->nullable();
            $table->unsignedBigInteger('agency_id')->nullable();
            $table->unsignedBigInteger('pengalaman_id')->nullable();
            $table->enum('dapatjob', ['YES', 'NO'])->nullable();





            // $table->enum('pengalaman')->nullable(); // Kolom untuk menyimpan pengalaman kerja sebelumnya

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biodatas');
    }
}
