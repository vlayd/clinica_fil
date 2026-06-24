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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('active')->default(1);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('cep')->unique();
            $table->string('logradouro');
            $table->string('bairro');
            $table->string('localidade');
            $table->string('uf');
            $table->string('estado');
        });

        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('birth')->nullable();
            $table->string('cpf')->unique();
            $table->foreignId('user_id')->constrained()->nullable();
            $table->foreignId('address_id')->constrained()->nullable(); //<- Se a outra tabela, tiver o nome 'addresses', fica assim
            $table->string('address_number')->nullable();
            $table->string('address_complement')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('birth')->nullable();
            $table->string('cpf')->unique();
            $table->foreignId('user_id')->constrained()->nullable();
            $table->foreignId('address_id')->constrained()->nullable(); //<- Se a outra tabela, tiver o nome 'addresses', fica assim
            $table->string('address_number')->nullable();
            $table->string('address_complement')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('patients');
        Schema::dropIfExists('employes');
        Schema::dropIfExists('addresses');
        Schema::dropIfExists('users');
    }
};
