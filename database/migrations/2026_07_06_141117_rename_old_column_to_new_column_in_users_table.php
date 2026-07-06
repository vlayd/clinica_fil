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
            // Arguments: renameColumn('current_name', 'new_name')
            $table->renameColumn('address_logradouro', 'street');
            $table->renameColumn('address_cep', 'zip_code');
            $table->renameColumn('address_number', 'number');
            $table->renameColumn('address_bairro', 'neighborhood');
            $table->renameColumn('address_complement', 'complement');
            $table->renameColumn('address_cidade', 'city');
            $table->renameColumn('address_uf', 'state');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Reverse the names for rollback functionality
            $table->renameColumn('street', 'address_logradouro');
            $table->renameColumn('number', 'address_number');
            $table->renameColumn('zip_code', 'address_cep');
            $table->renameColumn('neighborhood', 'address_bairro');
            $table->renameColumn('complement', 'address_complement');
            $table->renameColumn('city', 'address_cidade');
            $table->renameColumn('state', 'address_uf');
        });
    }
};
