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
            $table->string('address_uf')->nullable()->after('rule');
            $table->string('address_cidade')->nullable()->after('rule');
            $table->string('address_bairro')->nullable()->after('rule');
            $table->string('address_complement')->nullable()->after('rule');
            $table->string('address_number')->nullable()->after('rule');
            $table->string('address_logradouro')->nullable()->after('rule');
            $table->string('address_cep')->nullable()->after('rule');
            $table->string('birth')->nullable()->after('rule');
            $table->string('cpf')->nullable()->after('rule');
            $table->string('photo')->nullable()->after('rule');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('cpf');
            $table->dropColumn('photo');
            $table->dropColumn('birth');
            $table->dropColumn('address_cep');
            $table->dropColumn('address_bairro');
            $table->dropColumn('address_logradouro');
            $table->dropColumn('address_number');
            $table->dropColumn('address_complement');
            $table->dropColumn('address_cidade');
            $table->dropColumn('address_uf');
        });
    }
};
