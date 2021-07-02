<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMNotarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->string('type');
            $table->timestamps();
        });

        Schema::create('notaris', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('alamat')->nullable();
            $table->text('domisili')->nullable();
            $table->unsignedBigInteger('partner_id')->nullable();

            $table->timestamps();

            $table->foreign('partner_id')
            ->references('id')
            ->on('notaris')
            ->onDelete('cascade');
        });

        Schema::create('cluster', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('formula')->nullable();

            $table->timestamps();
        });

        Schema::create('covernote', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('notaris_id');
            $table->unsignedBigInteger('cluster_id')->nullable();
            $table->string('no_covernote')->nullable();
            $table->date('tanggal_covernote')->nullable();
            $table->integer('durasi')->nullable();
            $table->date('jatuh_tempo')->nullable();
            $table->integer('os')->nullable();
            $table->enum('is_perpanjangan_sertifikat', [0, 1])->default(0);
            $table->string('nama_debitur')->nullable();
            $table->enum('status', [0, 1, 2])->default(0);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            
            $table->foreign('notaris_id')
                ->references('id')
                ->on('notaris')
                ->onDelete('cascade');
            $table->foreign('cluster_id')
                ->references('id')
                ->on('cluster')
                ->onDelete('cascade');
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('updated_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
        Schema::create('covernote_dokumen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('covernote_id');
            $table->string('nama')->nullable();
            $table->string('nomor')->nullable();
            $table->enum('status', [0, 1, 2])->default(0);
            $table->date('tanggal_terbit')->nullable();
            $table->date('tanggal_terima')->nullable();
            $table->integer('jumlah_salinan')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->unsignedBigInteger('tanda_terima_notaris')->nullable();
            $table->unsignedBigInteger('tanda_terima_debitur')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            
            $table->foreign('covernote_id')
                ->references('id')
                ->on('covernote')
                ->onDelete('cascade');
            $table->foreign('tanda_terima_notaris')
                ->references('id')
                ->on('file')
                ->onDelete('cascade');
            $table->foreign('tanda_terima_debitur')
                ->references('id')
                ->on('file')
                ->onDelete('cascade');
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('updated_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
        Schema::create('covernote_followup', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('covernote_dokumen_id');
            $table->enum('type', ['surat', 'telp', 'email']);
            $table->date('tanggal_followup');
            $table->text('hasil')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            
            $table->foreign('covernote_dokumen_id')
                ->references('id')
                ->on('covernote_dokumen')
                ->onDelete('cascade');
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('updated_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        Schema::create('surat_tagihan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('notaris_id');
            $table->integer('bulan');
            $table->integer('tahun');
            $table->date('tanggal_email');
            $table->unsignedBigInteger('file_id');
            $table->timestamps();

            $table->foreign('notaris_id')
                ->references('id')
                ->on('notaris')
                ->onDelete('cascade');
            $table->foreign('file_id')
                ->references('id')
                ->on('file')
                ->onDelete('cascade');
        });

        Schema::create('grup_hukum', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cluster_id');
            $table->integer('bulan');
            $table->integer('tahun');
            $table->date('tanggal_email');
            $table->unsignedBigInteger('file_id');
            $table->timestamps();

            $table->foreign('cluster_id')
                ->references('id')
                ->on('cluster')
                ->onDelete('cascade');
            $table->foreign('file_id')
                ->references('id')
                ->on('file')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file');
        Schema::dropIfExists('cluster');
        Schema::dropIfExists('notaris');
        Schema::dropIfExists('covernote');
        Schema::dropIfExists('covernote_dokumen');
        Schema::dropIfExists('covernote_followup');
        Schema::dropIfExists('surat_tagihan');
        Schema::dropIfExists('grup_hukum');
    }
}
