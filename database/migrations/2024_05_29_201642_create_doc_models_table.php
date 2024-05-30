<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doc_models', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->date('publier_le');
            $table->string('publier_par');
            $table->enum('extension', ['pdf', 'docx', 'xlsx', 'png', 'jpg']);
            $table->string('type_document');
            $table->enum('etat', ['publié', 'non_publié']);
            $table->text('description');
            $table->integer('nombre_vue')->default(0);
            $table->string('fichier');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doc_models');
    }
};