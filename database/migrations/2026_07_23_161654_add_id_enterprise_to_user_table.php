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
            $table->string('enterprise_id')->constrained()->nullable()->after('deleted_at');
        });

        Schema::table('positions', function (Blueprint $table) {
            $table->string('enterprise_id')->constrained()->nullable()->after('deleted_at');
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->string('enterprise_id')->constrained()->nullable()->after('updated_at');
        });

        Schema::table('agreements', function (Blueprint $table) {
            $table->string('enterprise_id')->constrained()->nullable()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('enterprise_id');
        });
        Schema::table('positions', function (Blueprint $table) {
            $table->dropColumn('enterprise_id');
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('enterprise_id');
        });
        Schema::table('agreements', function (Blueprint $table) {
            $table->dropColumn('enterprise_id');
        });
    }
};
