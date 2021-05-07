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
        Schema::create('notaris', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address')->nullable();
            $table->text('domicile')->nullable();
            $table->string('couple_name')->nullable();
            $table->integer('pending_akta')->default(0);

            $table->timestamps();
        });
        Schema::create('akta_hutang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_notaris');
            $table->string('no_covernote')->nullable();
            $table->date('tanggal_covernote')->nullable();
            $table->integer('durasi')->nullable();
            $table->date('jatuh_tempo')->nullable();
            $table->integer('os')->nullable();
            $table->enum('is_perpanjangan_sertifikat', ['Y', 'T'])->default('T');
            $table->string('cluster')->nullable();
            $table->string('nama_debitur')->nullable();
            $table->string('nama_dokumen')->nullable();
            $table->string('nomor_tanggal_dokumen')->nullable();
            $table->enum('status_dokumen', ['terima', 'belum terima'])->default('belum terima');
            $table->date('tanggal_terima_dokumen')->nullable();
            $table->integer('jumlah_salinan')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->date('tanggal_kirim_salinan')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            
            $table->foreign('id_notaris')
                ->references('id')
                ->on('notaris')
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
        Schema::create('akta_hutang_note', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_akta_hutang');
            $table->date('tanggal_note');
            $table->text('note')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            
            $table->foreign('id_akta_hutang')
                ->references('id')
                ->on('akta_hutang')
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notaris');
        Schema::dropIfExists('akta_hutang');
        Schema::dropIfExists('akta_hutang_note');
    }
}
