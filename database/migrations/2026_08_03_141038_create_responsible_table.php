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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('agreement_id')->constrained()->nullable()->after('remember_token');;
            $table->foreignId('position_id')->constrained()->nullable()->after('remember_token');
            $table->json('documents')->nullable()->after('remember_token');
            $table->string('name_responsible')->nullable()->after('remember_token');
            $table->string('cpf_responsible', 14)->nullable()->after('remember_token');
            $table->json('document_responsible')->nullable()->after('remember_token');
            $table->string('blood_type')->nullable()->after('remember_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_infos');
        Schema::dropIfExists('employe_infos');
    }
};
