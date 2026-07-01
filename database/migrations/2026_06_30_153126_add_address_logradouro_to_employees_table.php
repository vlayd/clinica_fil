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
        Schema::table('employes', function (Blueprint $table) {
            $table->string('address_cep')->nullable();
            $table->string('address_logradouro')->nullable();
            $table->string('address_bairro')->nullable();
            $table->string('address_cidade')->nullable();
            $table->string('address_uf')->nullable()->after('user_id');
        });

        Schema::table('patients', function (Blueprint $table) {
            $table->string('address_cep')->nullable();
            $table->string('address_logradouro')->nullable();
            $table->string('address_bairro')->nullable();
            $table->string('address_cidade')->nullable();
            $table->string('address_uf')->nullable()->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employes', function (Blueprint $table) {
            $table->dropColumn('address_cep');
            $table->dropColumn('address_logradouro');
            $table->dropColumn('address_bairro');
            $table->dropColumn('address_cidade');
            $table->dropColumn('address_uf');
        });
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn('address_cep');
            $table->dropColumn('address_logradouro');
            $table->dropColumn('address_bairro');
            $table->dropColumn('address_cidade');
            $table->dropColumn('address_uf');
        });
    }
};
